<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matching;
use Illuminate\Support\Facades\Auth;

class MatchController extends Controller
{
    /**
     * Display all matches for the authenticated user
     */
    public function index()
    {
        $userId = Auth::id();
        
        // Get all matches where user is either user1 or user2 and status is 'matched'
        $matches = Matching::with(['user1.profile.photos', 'user2.profile.photos'])
            ->where('status', 'matched')
            ->where(function($query) use ($userId) {
                $query->where('user1_id', $userId)
                      ->orWhere('user2_id', $userId);
            })
            ->orderBy('matched_at', 'desc')
            ->get()
            ->map(function($match) use ($userId) {
                // Get the other user (not current user)
                $match->otherUser = $match->user1_id == $userId ? $match->user2 : $match->user1;
                return $match;
            });
        
        return view('matches.index', compact('matches'));
    }
}
