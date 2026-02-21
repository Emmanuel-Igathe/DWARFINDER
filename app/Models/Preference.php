<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Preference extends Model
{
    protected $fillable = [
        'user_id', 'gender_preference', 'min_age', 'max_age',
        'min_height', 'max_height', 'likes_mining', 'likes_forging',
        'likes_gems', 'likes_ale', 'likes_adventure', 'must_like_beards',
        'must_be_verified'
    ];

    protected $casts = [
        'likes_mining' => 'boolean',
        'likes_forging' => 'boolean',
        'likes_gems' => 'boolean',
        'likes_ale' => 'boolean',
        'likes_adventure' => 'boolean',
        'must_like_beards' => 'boolean',
        'must_be_verified' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}