<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     *
     * The demo account is public on purpose (it is listed in the README),
     * so anyone trying the live site can log in without signing up.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Ana Patel',
            'email' => 'demo@example.com',
            'password' => 'password', // hashed automatically by the User model
        ]);
    }
}
