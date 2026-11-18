<?php

namespace Database\Seeders;

use App\MOdels\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@kinstudios.test'],
            [
                'name' => 'Kins Admin',
                'password' => Hash::make('Password123!'),
                'role' => 'admin',
                'phone' => '0812345678',
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'user1@email.test'],
            [
                'name' => 'Alex Turner',
                'password' => Hash::make('Password321!'),
                'role' => 'customer',
                'phone' => '0821212101',
                'email_verified_at' => now(),
            ]
        );
    }
}
