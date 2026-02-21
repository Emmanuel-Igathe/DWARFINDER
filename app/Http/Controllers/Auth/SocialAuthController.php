<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    /**
     * Redirect to social provider
     */
    public function redirectToProvider($provider)
    {
        // Validate provider
        if (!in_array($provider, ['facebook', 'google'])) {
            abort(404);
        }

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Handle social provider callback
     */
    public function handleProviderCallback($provider)
    {
        try {
            // Get user info from provider
            $socialUser = Socialite::driver($provider)->user();

            // Find or create user
            $user = User::where('provider', $provider)
                ->where('provider_id', $socialUser->getId())
                ->first();

            if (!$user) {
                // Check if user exists with same email
                $user = User::where('email', $socialUser->getEmail())->first();

                if ($user) {
                    // Link social account to existing user
                    $user->update([
                        'provider' => $provider,
                        'provider_id' => $socialUser->getId(),
                        'avatar' => $socialUser->getAvatar(),
                    ]);
                } else {
                    // Create new user
                    $user = User::create([
                        'name' => $socialUser->getName(),
                        'email' => $socialUser->getEmail(),
                        'provider' => $provider,
                        'provider_id' => $socialUser->getId(),
                        'avatar' => $socialUser->getAvatar(),
                        'email_verified_at' => now(), // Social accounts are pre-verified
                        'password' => null, // No password for social auth
                        'profile_completed' => false,
                    ]);
                }
            }

            // Log the user in
            Auth::login($user, true);

            // Redirect based on profile completion status
            if (!$user->profile_completed) {
                return redirect()->route('profile.setup.step1')
                    ->with('success', 'Welcome! Let\'s set up your profile.');
            }

            return redirect()->route('dashboard')
                ->with('success', 'Welcome back!');

        } catch (\Exception $e) {
            return redirect()->route('login')
                ->with('error', 'Unable to login with ' . ucfirst($provider) . '. Please try again.');
        }
    }
}
