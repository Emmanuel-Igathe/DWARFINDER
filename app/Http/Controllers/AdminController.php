<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class AdminController extends Controller
{
    /**
     * Display the Admin Dashboard
     */
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'admins' => User::where('role', 'admin')->count(),
            'completed_profiles' => User::where('profile_completed', true)->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    /**
     * List all users
     */
    public function users()
    {
        $users = User::with('profile')->latest()->paginate(20);
        return view('admin.users', compact('users'));
    }

    /**
     * Delete a user
     */
    public function destroyUser(User $user)
    {
        if ($user->isAdmin() && User::where('role', 'admin')->count() <= 1) {
            return back()->with('error', 'Cannot delete the last admin.');
        }

        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }

    /**
     * Toggle Admin Status
     */
    public function toggleAdmin(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot change your own role.');
        }

        $user->role = $user->role === 'admin' ? 'user' : 'admin';
        $user->save();

        return back()->with('success', 'User role updated.');
    }
}
