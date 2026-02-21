<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use App\Models\Preference;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        $admin = User::create([
            'name' => 'Dwarfinder Admin',
            'email' => 'admin@dwarfinder.com',
            'role' => 'admin',
            'password' => Hash::make('password'),
            'profile_completed' => true,
        ]);

        // Create Admin Profile
        Profile::create([
            'user_id' => $admin->id,
            'display_name' => 'Master Miner',
            'birth_date' => '1980-01-01',
            'gender' => 'male',
            'looking_for' => 'all',
            'height' => 120,
            'is_active' => true,
        ]);

        // Create Admin Preferences
        Preference::create([
            'user_id' => $admin->id,
            'gender_preference' => 'all',
            'min_age' => 18,
            'max_age' => 99,
        ]);

        $this->command->info('Admin account created: admin@dwarfinder.com / password');
    }
}
