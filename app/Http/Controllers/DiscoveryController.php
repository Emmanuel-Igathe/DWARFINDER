<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class DiscoveryController extends Controller
{
    /**
     * Display a listing of potential matches
     */
    public function index()
    {
        $currentUser = Auth::user();
        $currentProfile = $currentUser->profile;
        
        // Get users that:
        // 1. Are not the current user
        // 2. Have active profiles
        // 3. Match user's preference criteria
        // 4. Haven't been liked or matched yet
        $potentialMatches = User::with('profile.photos')
            ->whereHas('profile', function($query) use ($currentProfile) {
                $query->where('is_active', true)
                      ->where('user_id', '!=', Auth::id());
                
                // Filter by age preference if set
                if ($currentProfile) {
                    $minAge = $currentProfile->min_age_preference ?? 18;
                    $maxAge = $currentProfile->max_age_preference ?? 99;
                    
                    $query->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN ? AND ?', [$minAge, $maxAge]);
                }
            })
            ->whereDoesntHave('likedBy', function($query) {
                $query->where('user_id', Auth::id());
            })
            ->whereDoesntHave('matchesAsUser1', function($query) {
                $query->where('user2_id', Auth::id());
            })
            ->whereDoesntHave('matchesAsUser2', function($query) {
                $query->where('user1_id', Auth::id());
            })
            ->inRandomOrder()
            ->limit(20)
            ->get();
        
        return view('discover', compact('potentialMatches'));
    }
}
