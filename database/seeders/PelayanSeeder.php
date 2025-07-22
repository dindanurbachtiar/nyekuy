<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // Untuk hashing password

class PelayanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pelayan')->insert([
            [
                'id_pelayan' => 'P001',
                'nama_pelayan' => 'Dinda',
                'username' => 'admin1',
                'password' => Hash::make('password_admin1'), // Ganti dengan password yang Anda inginkan, lalu hash
            ],
            [
                'id_pelayan' => 'P002',
                'nama_pelayan' => 'Wanda',
                'username' => 'admin2',
                'password' => Hash::make('password_admin2'), // Ganti dengan password yang Anda inginkan, lalu hash
            ],
        ]);
    }
}
