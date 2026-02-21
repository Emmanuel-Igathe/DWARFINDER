<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;

class ProfileSetupController extends Controller
{
    /**
     * Step 1: Basic Information
     */
    public function step1()
    {
        $user = Auth::user();
        $profile = $user->profile;

        return view('profile-setup.step1', compact('user', 'profile'));
    }

    /**
     * Save Step 1
     */
    public function saveStep1(Request $request)
    {
        $validated = $request->validate([
            'display_name' => 'required|string|max:255',
            'birth_date' => 'required|date|before:today',
            'gender' => 'required|in:male,female,non_binary,other',
            'looking_for' => 'required|in:male,female,both,non_binary,all',
            'height' => 'nullable|integer|min:50|max:250',
        ]);

        $user = Auth::user();
        
        // Create or update profile
        $profile = $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'display_name' => $validated['display_name'],
                'birth_date' => $validated['birth_date'],
                'gender' => $validated['gender'],
                'looking_for' => $validated['looking_for'],
                'height' => $validated['height'] ?? null,
            ]
        );

        return redirect()->route('profile.setup.step2')
            ->with('success', 'Basic information saved!');
    }

    /**
     * Step 2: Photos
     */
    public function step2()
    {
        $user = Auth::user();
        $photos = Photo::where('user_id', $user->id)->orderBy('order')->get();

        return view('profile-setup.step2', compact('user', 'photos'));
    }

    /**
     * Save Step 2
     */
    public function saveStep2(Request $request)
    {
        $user = Auth::user();
        $photoCount = Photo::where('user_id', $user->id)->count();

        // Require at least 1 photo
        if ($photoCount < 1 && !$request->hasFile('photos')) {
            return back()->with('error', 'Please upload at least one photo.');
        }

        // If photos uploaded, handle them
        if ($request->hasFile('photos')) {
            $validated = $request->validate([
                'photos.*' => 'required|image|mimes:jpeg,png,jpg|max:5120', // 5MB max
            ]);

            foreach ($request->file('photos') as $index => $photo) {
                $path = $photo->store('photos', 'public');
                
                Photo::create([
                    'user_id' => $user->id,
                    'path' => $path,
                    'is_primary' => $photoCount == 0 && $index == 0, // First photo is primary
                    'order' => $photoCount + $index,
                ]);
            }
        }

        return redirect()->route('profile.setup.step3')
            ->with('success', 'Photos uploaded!');
    }

    /**
     * Step 3: Additional Details (Optional)
     */
    public function step3()
    {
        $user = Auth::user();
        $profile = $user->profile;

        return view('profile-setup.step3', compact('user', 'profile'));
    }

    /**
     * Save Step 3
     */
    public function saveStep3(Request $request)
    {
        $validated = $request->validate([
            'bio' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'beard_style' => 'nullable|string|max:50',
            'mountain_origin' => 'nullable|string|max:100',
            'craft_specialty' => 'nullable|string|max:100',
            'mining_expertise' => 'nullable|in:beginner,intermediate,expert,master',
        ]);

        $user = Auth::user();
        $user->profile()->update($validated);

        return $this->completeProfile();
    }

    /**
     * Skip optional fields
     */
    public function skip()
    {
        return $this->completeProfile();
    }

    /**
     * Mark profile as completed
     */
    private function completeProfile()
    {
        $user = Auth::user();
        $user->update(['profile_completed' => true]);

        return redirect()->route('dashboard')
            ->with('success', 'Profile setup complete! Welcome to Dwarfinder!');
    }
}
