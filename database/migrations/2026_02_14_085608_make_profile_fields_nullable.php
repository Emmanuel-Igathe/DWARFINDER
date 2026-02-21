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
        Schema::table('profiles', function (Blueprint $table) {
            // Make most fields nullable for profile setup wizard
            $table->string('display_name')->nullable()->change();
            $table->integer('height')->nullable()->change();
            
            // Dwarf-specific traits - all optional
            // beard_style, mountain_origin, craft_specialty, mining_expertise already nullable
            
            // Location - optional
            // city, country, latitude, longitude already nullable
            
            // Note: birth_date, gender, looking_for remain required
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('display_name')->nullable(false)->change();
            $table->integer('height')->nullable(false)->change();
        });
    }
};
