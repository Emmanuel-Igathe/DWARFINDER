<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Profile extends Model
{
    protected $fillable = [
        'user_id', 'display_name', 'bio', 'birth_date', 'gender',
        'looking_for', 'height', 'beard_style', 'mountain_origin',
        'craft_specialty', 'mining_expertise', 'city', 'country',
        'latitude', 'longitude', 'min_age_preference', 'max_age_preference',
        'min_height_preference', 'max_height_preference', 'is_verified', 'is_active'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'is_verified' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function photos()
    {
        if (class_exists('App\Models\Photo')) {
            return $this->hasMany(Photo::class, 'user_id', 'user_id');
        }
        return new \Illuminate\Database\Eloquent\Collection();
    }

    public function age(): int
    {
        return Carbon::parse($this->birth_date)->age;
    }

    public function primaryPhoto()
    {
        return null;
    }
}