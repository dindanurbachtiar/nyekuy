<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menu')->insert([
            ['kode_menu' => 'MN001', 'nama_menu' => 'Ceker', 'harga' => 3000, 'bahan_baku' => 'Ceker', 'kode_bahan' => 'BB001', 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN002', 'nama_menu' => 'Tulang', 'harga' => 3000, 'bahan_baku' => 'Tulang', 'kode_bahan' => 'BB002', 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN003', 'nama_menu' => 'Kerupuk Oren', 'harga' => 2000, 'bahan_baku' => 'Kerupuk Oren', 'kode_bahan' => 'BB003', 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN004', 'nama_menu' => 'Kerupuk Bintang', 'harga' => 2000, 'bahan_baku' => 'Kerupuk Bintang', 'kode_bahan' => 'BB004', 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN005', 'nama_menu' => 'Kerupuk Rantai', 'harga' => 2000, 'bahan_baku' => 'Kerupuk Rantai', 'kode_bahan' => 'BB005', 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN006', 'nama_menu' => 'Kerupuk Keong', 'harga' => 2000, 'bahan_baku' => 'Kerupuk Keong', 'kode_bahan' => 'BB006', 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN007', 'nama_menu' => 'Potato', 'harga' => 2000, 'bahan_baku' => 'Potato', 'kode_bahan' => 'BB007', 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN008', 'nama_menu' => 'Makaroni Kriuk', 'harga' => 2000, 'bahan_baku' => 'Makaroni Kriuk', 'kode_bahan' => 'BB008', 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN009', 'nama_menu' => 'Makaroni Spiral', 'harga' => 2000, 'bahan_baku' => 'Makaroni Spiral', 'kode_bahan' => 'BB009', 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN010', 'nama_menu' => 'Kwetiau', 'harga' => 2000, 'bahan_baku' => 'Kwetiau', 'kode_bahan' => 'BB010', 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN011', 'nama_menu' => 'Batagor Bulat', 'harga' => 3000, 'bahan_baku' => 'Batagor Bulat', 'kode_bahan' => 'BB011', 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN012', 'nama_menu' => 'Batagor Lidah', 'harga' => 1000, 'bahan_baku' => 'Batagor Lidah', 'kode_bahan' => 'BB012', 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN013', 'nama_menu' => 'Siomai Segitiga', 'harga' => 1000, 'bahan_baku' => 'Siomai Segitiga', 'kode_bahan' => 'BB013', 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN014', 'nama_menu' => 'Mie Golosor', 'harga' => 2000, 'bahan_baku' => 'Mie Golosor', 'kode_bahan' => 'BB014', 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN015', 'nama_menu' => 'Jamur Kuping', 'harga' => 2000, 'bahan_baku' => 'Jamur Kuping', 'kode_bahan' => 'BB015', 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN016', 'nama_menu' => 'Siomay', 'harga' => 1000, 'bahan_baku' => 'Siomay', 'kode_bahan' => 'BB016', 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN017', 'nama_menu' => 'Tahu Putih', 'harga' => 1000, 'bahan_baku' => 'Tahu Putih', 'kode_bahan' => 'BB017', 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN018', 'nama_menu' => 'Tahu Kuning', 'harga' => 1000, 'bahan_baku' => 'Tahu Kuning', 'kode_bahan' => 'BB018', 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN019', 'nama_menu' => 'Sawi Putih', 'harga' => 1000, 'bahan_baku' => 'Sawi Putih', 'kode_bahan' => 'BB019', 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN020', 'nama_menu' => 'Sawi Hijau', 'harga' => 1000, 'bahan_baku' => 'Sawi Hijau', 'kode_bahan' => 'BB020', 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN021', 'nama_menu' => 'Kangkung', 'harga' => 1000, 'bahan_baku' => 'Kangkung', 'kode_bahan' => 'BB021', 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN022', 'nama_menu' => 'Kol', 'harga' => 1000, 'bahan_baku' => 'Kol', 'kode_bahan' => 'BB022', 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN023', 'nama_menu' => 'Mie', 'harga' => 2000, 'bahan_baku' => 'Mie', 'kode_bahan' => 'BB023', 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN024', 'nama_menu' => 'Sosis', 'harga' => 2000, 'bahan_baku' => 'Sosis', 'kode_bahan' => 'BB024', 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN025', 'nama_menu' => 'Baso', 'harga' => 2000, 'bahan_baku' => 'Baso', 'kode_bahan' => 'BB025', 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN026', 'nama_menu' => 'Kikil', 'harga' => 2000, 'bahan_baku' => 'Kikil', 'kode_bahan' => 'BB026', 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN027', 'nama_menu' => 'Cilok', 'harga' => 1000, 'bahan_baku' => 'Cilok', 'kode_bahan' => 'BB027', 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN028', 'nama_menu' => 'Cuanki', 'harga' => 1000, 'bahan_baku' => 'Cuanki', 'kode_bahan' => 'BB028', 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN029', 'nama_menu' => 'Tahu Sumedang', 'harga' => 1000, 'bahan_baku' => 'Tahu Sumedang', 'kode_bahan' => 'BB029', 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN030', 'nama_menu' => 'Cirawang', 'harga' => 2000, 'bahan_baku' => 'Cirawang', 'kode_bahan' => 'BB030', 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN031', 'nama_menu' => 'Cibak', 'harga' => 2000, 'bahan_baku' => 'Cibak', 'kode_bahan' => 'BB031', 'created_at' => now(), 'updated_at' => now()],
            ['kode_menu' => 'MN032', 'nama_menu' => 'Makaroni Hitam', 'harga' => 2000, 'bahan_baku' => 'Makaroni Hitam', 'kode_bahan' => 'BB032', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
