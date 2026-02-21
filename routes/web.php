<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiscoveryController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\ProfileSetupController;
use App\Http\Middleware\EnsureProfileCompleted;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Social Authentication Routes
Route::get('/auth/{provider}', [SocialAuthController::class, 'redirectToProvider'])
    ->name('social.redirect');
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback'])
    ->name('social.callback');

// Profile Setup Routes (requires auth)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile-setup/step1', [ProfileSetupController::class, 'step1'])->name('profile.setup.step1');
    Route::post('/profile-setup/step1', [ProfileSetupController::class, 'saveStep1']);
    
    Route::get('/profile-setup/step2', [ProfileSetupController::class, 'step2'])->name('profile.setup.step2');
    Route::post('/profile-setup/step2', [ProfileSetupController::class, 'saveStep2']);
    
    Route::get('/profile-setup/step3', [ProfileSetupController::class, 'step3'])->name('profile.setup.step3');
    Route::post('/profile-setup/step3', [ProfileSetupController::class, 'saveStep3']);
    
    Route::post('/profile-setup/skip', [ProfileSetupController::class, 'skip'])->name('profile.setup.skip');
});

Route::middleware(['auth', 'verified', EnsureProfileCompleted::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Discovery/Browse
    Route::get('/discover', [DiscoveryController::class, 'index'])->name('discover.index');
    
    // Matches
    Route::get('/matches', [MatchController::class, 'index'])->name('matches.index');
    
    // Messages
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{match}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{match}', [MessageController::class, 'store'])->name('messages.store');
    
    // Likes
    Route::get('/likes', [LikeController::class, 'index'])->name('likes.index');
    Route::post('/like/{user}', [LikeController::class, 'store'])->name('like.store');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Public Profile
    Route::get('/users/{user}', [ProfileController::class, 'show'])->name('users.show');

    // Admin Routes
    Route::middleware(['admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
        Route::post('/users/{user}/toggle-admin', [AdminController::class, 'toggleAdmin'])->name('admin.toggle-admin');
        Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
    });
});


require __DIR__.'/auth.php';