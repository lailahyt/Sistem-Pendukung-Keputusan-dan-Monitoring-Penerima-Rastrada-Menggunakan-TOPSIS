<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'id' => '1',
            'name' => 'Admin',
            'keterangan' => 'Akses penuh sistem',
            'is_active' => true,
        ]);

        Role::create([
            'id' => '2',
            'name' => 'Petugas',
            'keterangan' => 'Input data, penilaian, dan monitoring',
            'is_active' => true,
        ]);

        Role::create([
            'id' => '3',
            'name' => 'Lurah',
            'keterangan' => 'Validasi dan persetujuan hasil',
            'is_active' => true,
        ]);
    }
}
