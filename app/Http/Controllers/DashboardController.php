<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Get authenticated user
        $user = Auth::user();
        
        // Load relationships
        if ($user) {
            $user->load(['profile', 'preferences']);
        }
        
        // Pass to view
        return view('dashboard', compact('user'));
    }
}