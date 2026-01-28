<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateFirstUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $data = [
        //     'name'     => 'Admin',
        //     'email'    => 'admin@gmail.com',
        //     'role'     => 'Admin',
        //     'password' => Hash::make('admin123'),
        // ];

        $data = [
            'name'     => 'Aidil Ikhsan',
            'email'    => 'aidil@gmail.com',
            'role'     => 'Super Admin',
            'password' => Hash::make('aidil123'),
        ];

        User::create($data);
    }
}
