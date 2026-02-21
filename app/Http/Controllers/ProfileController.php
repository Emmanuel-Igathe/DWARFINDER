<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Display the specified user's profile.
     */
    public function show(\App\Models\User $user): View
    {
        // Don't show own profile in public view (redirect to edit)
        if ($user->id === Auth::id()) {
            return view('profile.edit', ['user' => $user]);
        }

        $user->load('profile.photos');
        
        $currentUserId = Auth::id();
        
        // Check interaction status
        $hasLiked = $user->likedBy()->where('user_id', $currentUserId)->exists();
        $hasLikedMe = $user->liked()->where('liked_user_id', $currentUserId)->exists();
        
        $isMatched = \App\Models\Matching::where(function($q) use ($user, $currentUserId) {
                $q->where('user1_id', $currentUserId)->where('user2_id', $user->id);
            })
            ->orWhere(function($q) use ($user, $currentUserId) {
                $q->where('user1_id', $user->id)->where('user2_id', $currentUserId);
            })
            ->exists();

        return view('profile.show', compact('user', 'hasLiked', 'hasLikedMe', 'isMatched'));
    }
}
