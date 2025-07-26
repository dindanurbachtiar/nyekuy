<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuMinumanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menu_minuman')->insert([
            ['kode_menu' => 'MN101', 'nama_menu' => 'Es Teh Manis', 'harga' => 5000, 'stok' => 50, 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN102', 'nama_menu' => 'Es Jeruk', 'harga' => 6000, 'stok' => 40, 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN103', 'nama_menu' => 'Kopi Hitam', 'harga' => 7000, 'stok' => 30, 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN104', 'nama_menu' => 'Kopi Susu', 'harga' => 8000, 'stok' => 35, 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN105', 'nama_menu' => 'Jus Alpukat', 'harga' => 10000, 'stok' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN106', 'nama_menu' => 'Jus Mangga', 'harga' => 9000, 'stok' => 25, 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN107', 'nama_menu' => 'Jus Melon', 'harga' => 9000, 'stok' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN108', 'nama_menu' => 'Air Mineral', 'harga' => 3000, 'stok' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN109', 'nama_menu' => 'Susu Coklat Dingin', 'harga' => 8500, 'stok' => 30, 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN110', 'nama_menu' => 'Teh Tarik', 'harga' => 7500, 'stok' => 30, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
