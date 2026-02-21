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
        // database/migrations/xxxx_create_profiles_table.php
Schema::create('profiles', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    
    // Basic info
    $table->string('display_name');
    $table->text('bio')->nullable();
    $table->date('birth_date');
    $table->enum('gender', ['male', 'female', 'non_binary', 'other']);
    $table->enum('looking_for', ['male', 'female', 'both', 'non_binary', 'all']);
    
    // Dwarf-specific traits
    $table->integer('height')->comment('Height in cm');
    $table->string('beard_style')->nullable();
    $table->string('mountain_origin')->nullable();
    $table->string('craft_specialty')->nullable();
    $table->enum('mining_expertise', ['beginner', 'intermediate', 'expert', 'master'])->nullable();
    
    // Location
    $table->string('city')->nullable();
    $table->string('country')->nullable();
    $table->decimal('latitude', 10, 8)->nullable();
    $table->decimal('longitude', 11, 8)->nullable();
    
    // Preferences
    $table->integer('min_age_preference')->default(18);
    $table->integer('max_age_preference')->default(99);
    $table->integer('min_height_preference')->nullable();
    $table->integer('max_height_preference')->nullable();
    
    // Stats
    $table->integer('profile_views')->default(0);
    $table->integer('like_count')->default(0);
    $table->integer('match_count')->default(0);
    
    // Verification
    $table->boolean('is_verified')->default(false);
    $table->boolean('is_active')->default(true);
    
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
