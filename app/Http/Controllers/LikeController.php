<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Matching;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Store a new like and check for match
     */
    public function store(User $user, Request $request)
    {
        $currentUserId = Auth::id();
        $isAjax = $request->ajax() || $request->wantsJson();

        // Prevent liking yourself
        if ($user->id == $currentUserId) {
            return $isAjax
                ? response()->json(['error' => 'Cannot like yourself'], 422)
                : redirect()->back()->with('error', 'Cannot like yourself');
        }

        // Check if already liked
        $existingLike = Like::where('user_id', $currentUserId)
            ->where('liked_user_id', $user->id)
            ->first();

        if ($existingLike) {
            return $isAjax
                ? response()->json(['matched' => false, 'info' => 'Already liked'])
                : redirect()->back()->with('info', 'Already liked this user');
        }

        // Create the like
        Like::create([
            'user_id'      => $currentUserId,
            'liked_user_id'=> $user->id,
        ]);

        // Check for mutual like → match!
        $mutualLike = Like::where('user_id', $user->id)
            ->where('liked_user_id', $currentUserId)
            ->first();

        if ($mutualLike) {
            // Avoid duplicate match record
            $alreadyMatched = Matching::where(function($q) use ($currentUserId, $user) {
                $q->where('user1_id', min($currentUserId, $user->id))
                  ->where('user2_id', max($currentUserId, $user->id));
            })->exists();

            if (!$alreadyMatched) {
                Matching::create([
                    'user1_id'   => min($currentUserId, $user->id),
                    'user2_id'   => max($currentUserId, $user->id),
                    'status'     => 'matched',
                    'matched_at' => now(),
                ]);
            }

            return $isAjax
                ? response()->json(['matched' => true, 'message' => "It's a match! 💖"])
                : redirect()->route('matches.index')->with('success', "It's a match! 💖");
        }

        return $isAjax
            ? response()->json(['matched' => false, 'message' => 'Like sent!'])
            : redirect()->route('discover.index')->with('success', 'Like sent!');
    }

    /**
     * Display a listing of users who liked the current user
     */
    public function index()
    {
        $userId = Auth::id();
        
        // Get users who liked the current user but are not yet matched
        $likesReceived = User::whereHas('liked', function($q) use ($userId) {
            $q->where('liked_user_id', $userId);
        })
        ->whereDoesntHave('matchesAsUser1', function($q) use ($userId) {
            $q->where('user2_id', $userId);
        })
        ->whereDoesntHave('matchesAsUser2', function($q) use ($userId) {
            $q->where('user1_id', $userId);
        })
        ->with('profile.photos')
        ->get();

        return view('likes.index', compact('likesReceived'));
    }
}
