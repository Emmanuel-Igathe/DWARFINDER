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
            // Make remaining required fields nullable to allow registration before profile setup
            $table->date('birth_date')->nullable()->change();
            $table->string('gender')->nullable()->change();
            $table->string('looking_for')->nullable()->change();
        });

        Schema::table('users', function (Blueprint $table) {
            // Add role column for Admin support
            $table->string('role')->default('user')->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->date('birth_date')->nullable(false)->change();
            $table->string('gender')->nullable(false)->change();
            $table->string('looking_for')->nullable(false)->change();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
