<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin Studio',
            'email' => 'admin@studio.mu',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Photographer
        User::create([
            'name' => 'Photographer One',
            'email' => 'photo@studio.mu',
            'password' => Hash::make('password'),
            'role' => 'photographer',
        ]);

        // Customer
        User::create([
            'name' => 'Customer User',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);
    }
}
