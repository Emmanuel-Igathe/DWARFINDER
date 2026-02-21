<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matching;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display all conversations
     */
    public function index()
    {
        $userId = Auth::id();
        
        // Get all matches with latest message
        $conversations = Matching::with(['user1.profile', 'user2.profile', 'messages' => function($query) {
                $query->latest()->limit(1);
            }])
            ->where('status', 'matched')
            ->where(function($query) use ($userId) {
                $query->where('user1_id', $userId)
                      ->orWhere('user2_id', $userId);
            })
            ->get()
            ->map(function($match) use ($userId) {
                $match->otherUser = $match->user1_id == $userId ? $match->user2 : $match->user1;
                $match->latestMessage = $match->messages->first();
                $match->unreadCount = $match->messages()
                    ->where('receiver_id', $userId)
                    ->where('is_read', false)
                    ->count();
                return $match;
            })
            ->sortByDesc(function($match) {
                return $match->latestMessage ? $match->latestMessage->created_at : $match->matched_at;
            });
        
        return view('messages.index', compact('conversations'));
    }
    
    /**
     * Display a specific conversation
     */
    public function show(Matching $match)
    {
        $userId = Auth::id();
        
        // Verify user is part of this match
        if ($match->user1_id != $userId && $match->user2_id != $userId) {
            abort(403, 'Unauthorized');
        }
        
        $otherUser = $match->user1_id == $userId ? $match->user2 : $match->user1;
        
        // Get all messages for this match
        $messages = Message::where('match_id', $match->id)
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'asc')
            ->get();
        
        // Mark messages as read
        Message::where('match_id', $match->id)
            ->where('receiver_id', $userId)
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'read_at' => now()
            ]);
        
        return view('messages.show', compact('match', 'otherUser', 'messages'));
    }
    
    /**
     * Store a new message
     */
    public function store(Request $request, Matching $match)
    {
        $userId = Auth::id();
        
        // Verify user is part of this match
        if ($match->user1_id != $userId && $match->user2_id != $userId) {
            abort(403, 'Unauthorized');
        }
        
        $request->validate([
            'message' => 'required|string|max:1000'
        ]);
        
        $receiverId = $match->user1_id == $userId ? $match->user2_id : $match->user1_id;
        
        $message = Message::create([
            'match_id' => $match->id,
            'sender_id' => $userId,
            'receiver_id' => $receiverId,
            'message' => $request->message,
        ]);
        
        return redirect()->route('messages.show', $match);
    }
}
