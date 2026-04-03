<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => 'password',
            'status' => 'approved',
            'role_id' => 1,
        ]);
        User::create([
            'id' => 2,
            'name' => 'Petugas',
            'email' => 'petugas@gmail.com',
            'password' => 'password',
            'status' => 'approved',
            'role_id' => 2,
        ]);
        User::create([
            'id' => 3,
            'name' => 'Lurah',
            'email' => 'lurah@gmail.com',
            'password' => 'password',
            'status' => 'approved',
            'role_id' => 3,
        ]);


    }
}
