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
        Schema::table('likes', function (Blueprint $table) {
            if (!Schema::hasColumn('likes', 'user_id')) {
                $table->foreignId('user_id')->after('id')->constrained()->onDelete('cascade');
            }
            if (!Schema::hasColumn('likes', 'liked_user_id')) {
                $table->foreignId('liked_user_id')->after('user_id')->constrained('users')->onDelete('cascade');
            }
            
            // Re-adding unique constraint if columns were added
            $table->unique(['user_id', 'liked_user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('likes', function (Blueprint $table) {
            $table->dropUnique(['user_id', 'liked_user_id']);
            $table->dropColumn(['user_id', 'liked_user_id']);
        });
    }
};
