<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WilayahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['rw' => '1', 'rt' => '1'],
            ['rw' => '1', 'rt' => '2'],

            ['rw' => '2', 'rt' => '3'],
            ['rw' => '2', 'rt' => '4'],

            ['rw' => '3', 'rt' => '5'],
            ['rw' => '3', 'rt' => '6'],

            ['rw' => '4', 'rt' => '7'],
            ['rw' => '4', 'rt' => '8'],

            ['rw' => '5', 'rt' => '9'],
            ['rw' => '5', 'rt' => '10'],
            ['rw' => '5', 'rt' => '11'],
        ];

        DB::table('wilayah')->insert($data);
    }
}
