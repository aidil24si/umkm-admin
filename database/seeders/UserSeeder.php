<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // ===== Admin (1 akun tetap) =====
        User::create([
            'name'            => 'Administrator',
            'email'           => 'admin@example.com',
            'password'        => 'password', // otomatis di-hash oleh cast
            'role'            => 'Admin',
            'profile_picture' => null,
        ]);

        // ===== User biasa (misal 10 data) =====
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name'            => $faker->name,
                'email'           => $faker->unique()->safeEmail,
                'password'        => 'password',
                'role'            => 'User',
                'profile_picture' => null,
            ]);
        }
    }
}
