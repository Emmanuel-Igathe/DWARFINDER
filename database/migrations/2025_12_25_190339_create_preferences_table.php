<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('preferences', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    
    // Looking for
    $table->enum('gender_preference', ['male', 'female', 'both', 'non_binary', 'all']);
    $table->integer('min_age')->default(18);
    $table->integer('max_age')->default(99);
    $table->integer('min_height')->nullable();
    $table->integer('max_height')->nullable();
    
    // Personality traits (for dwarf theme)
    $table->boolean('likes_mining')->default(false);
    $table->boolean('likes_forging')->default(false);
    $table->boolean('likes_gems')->default(false);
    $table->boolean('likes_ale')->default(false);
    $table->boolean('likes_adventure')->default(false);
    
    // Deal breakers
    $table->boolean('must_like_beards')->default(false);
    $table->boolean('must_be_verified')->default(false);
    
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preferences');
    }
};
