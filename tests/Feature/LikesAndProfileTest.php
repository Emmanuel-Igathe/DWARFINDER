<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Profile;
use App\Models\Like;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LikesAndProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_view_another_user_profile()
    {
        $user = User::factory()->create(['profile_completed' => true]);
        $this->createProfile($user);
        
        $otherUser = User::factory()->create(['profile_completed' => true]);
        $this->createProfile($otherUser, ['display_name' => 'Other User']);

        $response = $this->actingAs($user)->get(route('users.show', $otherUser));

        $response->assertStatus(200);
        $response->assertSee('Other User');
    }

    public function test_cannot_view_own_profile_via_public_route()
    {
        $user = User::factory()->create(['profile_completed' => true]);
        $this->createProfile($user);

        $response = $this->actingAs($user)->get(route('users.show', $user));

        // Should return view directly as per controller logic
        $response->assertStatus(200);
        $response->assertViewIs('profile.edit');
    }

    public function test_can_see_likes_received()
    {
        $user = User::factory()->create(['profile_completed' => true]);
        $this->createProfile($user);
        
        $liker = User::factory()->create(['profile_completed' => true]);
        $this->createProfile($liker, ['display_name' => 'Liker User']);

        // Liker likes User
        Like::create([
            'user_id' => $liker->id,
            'liked_user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->get(route('likes.index'));

        $response->assertStatus(200);
        $response->assertSee('Liker User');
    }

    public function test_matches_do_not_appear_in_likes()
    {
        $user = User::factory()->create(['profile_completed' => true]);
        $this->createProfile($user);
        
        $matcher = User::factory()->create(['profile_completed' => true]);
        $this->createProfile($matcher, ['display_name' => 'Matcher User']);

        // Mutual like => Match
        Like::create(['user_id' => $matcher->id, 'liked_user_id' => $user->id]);
        Like::create(['user_id' => $user->id, 'liked_user_id' => $matcher->id]);

        \App\Models\Matching::create([
            'user1_id' => min($user->id, $matcher->id),
            'user2_id' => max($user->id, $matcher->id),
            'status' => 'matched',
            'matched_at' => now(),
        ]);

        $response = $this->actingAs($user)->get(route('likes.index'));

        $response->assertStatus(200);
        $response->assertDontSee('Matcher User');
    }

    private function createProfile($user, $attributes = [])
    {
        return Profile::create(array_merge([
            'user_id' => $user->id,
            'display_name' => $user->name,
            'birth_date' => '1990-01-01',
            'gender' => 'male',
            'looking_for' => 'female',
            'height' => 170,
            'is_active' => true,
        ], $attributes));
    }
}
