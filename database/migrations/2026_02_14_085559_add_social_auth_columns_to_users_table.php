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
        Schema::table('users', function (Blueprint $table) {
            $table->string('provider')->nullable()->after('email'); // facebook, google, email
            $table->string('provider_id')->nullable()->after('provider'); // OAuth user ID
            $table->string('avatar')->nullable()->after('provider_id'); // Profile photo URL
            $table->boolean('profile_completed')->default(false)->after('avatar'); // Track profile setup completion
            $table->string('password')->nullable()->change(); // Make password nullable for social auth
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['provider', 'provider_id', 'avatar', 'profile_completed']);
            $table->string('password')->nullable(false)->change(); // Revert password to required
        });
    }
};
