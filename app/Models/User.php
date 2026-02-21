<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
        'provider',
        'provider_id',
        'avatar',
        'profile_completed',
    ];

    /**
     * Check if the user is an admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's profile
     */
    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * Get the user's preferences
     */
    public function preferences(): HasOne
    {
        return $this->hasOne(Preference::class);
    }

    /**
     * Get matches where this user is user1
     */
    public function matchesAsUser1(): HasMany
    {
        return $this->hasMany(Matching::class, 'user1_id');
    }

    /**
     * Get matches where this user is user2
     */
    public function matchesAsUser2(): HasMany
    {
        return $this->hasMany(Matching::class, 'user2_id');
    }

    /**
     * Get all matches for this user
     */
    public function matches()
    {
        return Matching::where('user1_id', $this->id)
            ->orWhere('user2_id', $this->id)
            ->where('status', 'matched')
            ->get();
    }

    /**
     * Get users this user has liked
     */
    public function liked(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'likes', 'user_id', 'liked_user_id');
    }

    /**
     * Get users who have liked this user
     */
    public function likedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'likes', 'liked_user_id', 'user_id');
    }

    /**
     * Get messages sent by this user
     */
    public function sentMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    /**
     * Get messages received by this user
     */
    public function receivedMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }
}

