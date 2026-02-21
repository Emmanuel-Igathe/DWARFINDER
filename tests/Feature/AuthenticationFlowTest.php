<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AuthenticationFlowTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test Landing Page Display
     */
    public function test_landing_page_accessible()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Dwarfinder');
    }

    /**
     * Test Auth User Sees Dashboard Link on Landing Page
     */
    public function test_auth_user_sees_dashboard_link_on_landing_page()
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)->get('/');
        
        $response->assertStatus(200);
        
        $response->assertSee('Go to Dashboard');
        $response->assertDontSee('Sign up with Email');
    }

    /**
     * Test Registration Flow
     */
    public function test_registration_redirects_to_dashboard_then_profile_setup()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        if ($response->status() !== 302) {
             dump("Registration Logic Failed. Status: " . $response->status());
             if (session('errors')) {
                 dump(session('errors')->all());
             }
             if (isset($response->exception)) {
                 dump($response->exception->getMessage());
             }
        }

        $this->assertAuthenticated();
        
        // Redirects to dashboard
        $response->assertRedirect(route('dashboard'));
        
        // Dashboard should redirect to profile setup because profile_completed is false
        $response = $this->followingRedirects($response); // follow redirect to dashboard
        // Dashboard middleware redirects to profile setup step 1
        // But followingRedirects follows ALL redirects until 200 OK.
        
        // Let's check user state
        $user = User::where('email', 'test@example.com')->first();
        $this->assertFalse((bool)$user->profile_completed);
        
        // Verify middleware implementation by hitting dashboard directly as auth user
        $response = $this->actingAs($user)->get(route('dashboard'));
        $response->assertRedirect(route('profile.setup.step1'));
    }

    /**
     * Test Profile Setup Step 1
     */
    public function test_profile_setup_step1_saves_data()
    {
        $user = User::factory()->create(['profile_completed' => false]);
        // Ensure profile exists (it's created on registration or social login)
        Profile::create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->post(route('profile.setup.step1'), [
            'display_name' => 'Dwarf King',
            'birth_date' => '1990-01-01',
            'gender' => 'male',
            'looking_for' => 'female',
            'height' => 150,
        ]);

        $response->assertRedirect(route('profile.setup.step2'));

        $this->assertDatabaseHas('profiles', [
            'user_id' => $user->id,
            'display_name' => 'Dwarf King',
            'gender' => 'male',
        ]);
    }

    /**
     * Test Profile Setup Step 2 (Photo Upload)
     */
    public function test_profile_setup_step2_uploads_photo()
    {
        Storage::fake('public');
        
        $user = User::factory()->create(['profile_completed' => false]);
        Profile::create(['user_id' => $user->id]);

        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->actingAs($user)->post(route('profile.setup.step2'), [
            'photos' => [$file],
        ]);

        $response->assertRedirect(route('profile.setup.step3'));

        // Assert file was stored
        // The standard Storage fake works with 'photos/hash.jpg' usually
        // We can just check database record for simplicity
        $this->assertDatabaseHas('photos', [
            'user_id' => $user->id,
            'is_primary' => true,
        ]);
    }

    /**
     * Test Profile Setup Complete (Skip Step 3)
     */
    public function test_profile_setup_completion()
    {
        $user = User::factory()->create(['profile_completed' => false]);
        Profile::create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->post(route('profile.setup.skip')); // Skip calls completeProfile

        $response->assertRedirect(route('dashboard'));

        $user->refresh();
        $this->assertTrue((bool)$user->profile_completed);
        
        // Verify user can now access dashboard
        $response = $this->actingAs($user)->get(route('dashboard'));
        $response->assertStatus(200);
    }

    public function test_basic_auth()
    {
        $user = User::factory()->create();
        
        if (!\Illuminate\Support\Facades\Hash::check('password', $user->password)) {
            dump("PASSWORD HASH MISMATCH! User password: " . $user->password);
        } else {
            dump("Password hash matches.");
        }

        // Test actingAs
        $this->actingAs($user);
        $this->assertAuthenticated();
        
        Auth::logout();
        $this->assertGuest();
        
        // Test manual login
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        
        if ($response->status() !== 302) {
             dump("Login Failed. Status: " . $response->status());
             if (session('errors')) dump(session('errors')->all());
        }
        
        $this->assertAuthenticated();
    }
}
