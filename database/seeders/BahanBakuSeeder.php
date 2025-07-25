<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BahanBakuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data bahan baku yang direferensikan oleh menu
        $bahanBakuData = [
    ['kode_bahan' => 'BB001', 'nama_bahan_baku' => 'Ceker', 'stok' => 75, 'created_at' => now(), 'updated_at' => now()],
    ['kode_bahan' => 'BB002', 'nama_bahan_baku' => 'Tulang', 'stok' => 42, 'created_at' => now(), 'updated_at' => now()],
    ['kode_bahan' => 'BB003', 'nama_bahan_baku' => 'Kerupuk Oren', 'stok' => 88, 'created_at' => now(), 'updated_at' => now()],
    ['kode_bahan' => 'BB004', 'nama_bahan_baku' => 'Kerupuk Bintang', 'stok' => 37, 'created_at' => now(), 'updated_at' => now()],
    ['kode_bahan' => 'BB005', 'nama_bahan_baku' => 'Kerupuk Rantai', 'stok' => 91, 'created_at' => now(), 'updated_at' => now()],
    ['kode_bahan' => 'BB006', 'nama_bahan_baku' => 'Kerupuk Keong', 'stok' => 66, 'created_at' => now(), 'updated_at' => now()],
    ['kode_bahan' => 'BB007', 'nama_bahan_baku' => 'Potato', 'stok' => 24, 'created_at' => now(), 'updated_at' => now()],
    ['kode_bahan' => 'BB008', 'nama_bahan_baku' => 'Makaroni Kriuk', 'stok' => 53, 'created_at' => now(), 'updated_at' => now()],
    ['kode_bahan' => 'BB009', 'nama_bahan_baku' => 'Makaroni Spiral', 'stok' => 68, 'created_at' => now(), 'updated_at' => now()],
    ['kode_bahan' => 'BB010', 'nama_bahan_baku' => 'Kwetiau', 'stok' => 82, 'created_at' => now(), 'updated_at' => now()],
    ['kode_bahan' => 'BB011', 'nama_bahan_baku' => 'Batagor Bulat', 'stok' => 40, 'created_at' => now(), 'updated_at' => now()],
    ['kode_bahan' => 'BB012', 'nama_bahan_baku' => 'Batagor Lidah', 'stok' => 59, 'created_at' => now(), 'updated_at' => now()],
    ['kode_bahan' => 'BB013', 'nama_bahan_baku' => 'Siomai Segitiga', 'stok' => 33, 'created_at' => now(), 'updated_at' => now()],
    ['kode_bahan' => 'BB014', 'nama_bahan_baku' => 'Mie Golosor', 'stok' => 49, 'created_at' => now(), 'updated_at' => now()],
    ['kode_bahan' => 'BB015', 'nama_bahan_baku' => 'Jamur Kuping', 'stok' => 93, 'created_at' => now(), 'updated_at' => now()],
    ['kode_bahan' => 'BB016', 'nama_bahan_baku' => 'Siomay', 'stok' => 21, 'created_at' => now(), 'updated_at' => now()],
    ['kode_bahan' => 'BB017', 'nama_bahan_baku' => 'Tahu Putih', 'stok' => 77, 'created_at' => now(), 'updated_at' => now()],
    ['kode_bahan' => 'BB018', 'nama_bahan_baku' => 'Tahu Kuning', 'stok' => 65, 'created_at' => now(), 'updated_at' => now()],
    ['kode_bahan' => 'BB019', 'nama_bahan_baku' => 'Sawi Putih', 'stok' => 31, 'created_at' => now(), 'updated_at' => now()],
    ['kode_bahan' => 'BB020', 'nama_bahan_baku' => 'Sawi Hijau', 'stok' => 80, 'created_at' => now(), 'updated_at' => now()],
    ['kode_bahan' => 'BB021', 'nama_bahan_baku' => 'Kangkung', 'stok' => 46, 'created_at' => now(), 'updated_at' => now()],
    ['kode_bahan' => 'BB022', 'nama_bahan_baku' => 'Kol', 'stok' => 29, 'created_at' => now(), 'updated_at' => now()],
    ['kode_bahan' => 'BB023', 'nama_bahan_baku' => 'Mie', 'stok' => 74, 'created_at' => now(), 'updated_at' => now()],
    ['kode_bahan' => 'BB024', 'nama_bahan_baku' => 'Sosis', 'stok' => 95, 'created_at' => now(), 'updated_at' => now()],
    ['kode_bahan' => 'BB025', 'nama_bahan_baku' => 'Baso', 'stok' => 35, 'created_at' => now(), 'updated_at' => now()],
    ['kode_bahan' => 'BB026', 'nama_bahan_baku' => 'Kikil', 'stok' => 58, 'created_at' => now(), 'updated_at' => now()],
    ['kode_bahan' => 'BB027', 'nama_bahan_baku' => 'Cilok', 'stok' => 84, 'created_at' => now(), 'updated_at' => now()],
    ['kode_bahan' => 'BB028', 'nama_bahan_baku' => 'Cuanki', 'stok' => 19, 'created_at' => now(), 'updated_at' => now()],
    ['kode_bahan' => 'BB029', 'nama_bahan_baku' => 'Tahu Sumedang', 'stok' => 92, 'created_at' => now(), 'updated_at' => now()],
    ['kode_bahan' => 'BB030', 'nama_bahan_baku' => 'Cirawang', 'stok' => 50, 'created_at' => now(), 'updated_at' => now()],
    ['kode_bahan' => 'BB031', 'nama_bahan_baku' => 'Cibak', 'stok' => 63, 'created_at' => now(), 'updated_at' => now()],
    ['kode_bahan' => 'BB032', 'nama_bahan_baku' => 'Makaroni Hitam', 'stok' => 39, 'created_at' => now(), 'updated_at' => now()],
];


        DB::table('bahan_baku')->insert($bahanBakuData);
    }
}
