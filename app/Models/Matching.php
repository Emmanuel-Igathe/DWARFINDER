<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matching extends Model
{
    use HasFactory;

    protected $table = 'matches'; // Table name is 'matches' but model is 'Matching'

    protected $fillable = [
        'user1_id',
        'user2_id',
        'status',
        'matched_at'
    ];

    protected $casts = [
        'matched_at' => 'datetime',
    ];

    // Relationships
    public function user1()
    {
        return $this->belongsTo(User::class, 'user1_id');
    }

    public function user2()
    {
        return $this->belongsTo(User::class, 'user2_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}