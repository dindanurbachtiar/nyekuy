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
            ['kode_bahan' => 'BB001', 'nama_bahan_baku' => 'Ceker', 'created_at' => now(), 'updated_at' => now()],
            ['kode_bahan' => 'BB002', 'nama_bahan_baku' => 'Tulang', 'created_at' => now(), 'updated_at' => now()],
            ['kode_bahan' => 'BB003', 'nama_bahan_baku' => 'Kerupuk Oren', 'created_at' => now(), 'updated_at' => now()],
            ['kode_bahan' => 'BB004', 'nama_bahan_baku' => 'Kerupuk Bintang', 'created_at' => now(), 'updated_at' => now()],
            ['kode_bahan' => 'BB005', 'nama_bahan_baku' => 'Kerupuk Rantai', 'created_at' => now(), 'updated_at' => now()],
            ['kode_bahan' => 'BB006', 'nama_bahan_baku' => 'Kerupuk Keong', 'created_at' => now(), 'updated_at' => now()],
            ['kode_bahan' => 'BB007', 'nama_bahan_baku' => 'Potato', 'created_at' => now(), 'updated_at' => now()],
            ['kode_bahan' => 'BB008', 'nama_bahan_baku' => 'Makaroni Kriuk', 'created_at' => now(), 'updated_at' => now()],
            ['kode_bahan' => 'BB009', 'nama_bahan_baku' => 'Makaroni Spiral', 'created_at' => now(), 'updated_at' => now()],
            ['kode_bahan' => 'BB010', 'nama_bahan_baku' => 'Kwetiau', 'created_at' => now(), 'updated_at' => now()],
            ['kode_bahan' => 'BB011', 'nama_bahan_baku' => 'Batagor Bulat', 'created_at' => now(), 'updated_at' => now()],
            ['kode_bahan' => 'BB012', 'nama_bahan_baku' => 'Batagor Lidah', 'created_at' => now(), 'updated_at' => now()],
            ['kode_bahan' => 'BB013', 'nama_bahan_baku' => 'Siomai Segitiga', 'created_at' => now(), 'updated_at' => now()],
            ['kode_bahan' => 'BB014', 'nama_bahan_baku' => 'Mie Golosor', 'created_at' => now(), 'updated_at' => now()],
            ['kode_bahan' => 'BB015', 'nama_bahan_baku' => 'Jamur Kuping', 'created_at' => now(), 'updated_at' => now()],
            ['kode_bahan' => 'BB016', 'nama_bahan_baku' => 'Siomay', 'created_at' => now(), 'updated_at' => now()],
            ['kode_bahan' => 'BB017', 'nama_bahan_baku' => 'Tahu Putih', 'created_at' => now(), 'updated_at' => now()],
            ['kode_bahan' => 'BB018', 'nama_bahan_baku' => 'Tahu Kuning', 'created_at' => now(), 'updated_at' => now()],
            ['kode_bahan' => 'BB019', 'nama_bahan_baku' => 'Sawi Putih', 'created_at' => now(), 'updated_at' => now()],
            ['kode_bahan' => 'BB020', 'nama_bahan_baku' => 'Sawi Hijau', 'created_at' => now(), 'updated_at' => now()],
            ['kode_bahan' => 'BB021', 'nama_bahan_baku' => 'Kangkung', 'created_at' => now(), 'updated_at' => now()],
            ['kode_bahan' => 'BB022', 'nama_bahan_baku' => 'Kol', 'created_at' => now(), 'updated_at' => now()],
            ['kode_bahan' => 'BB023', 'nama_bahan_baku' => 'Mie', 'created_at' => now(), 'updated_at' => now()],
            ['kode_bahan' => 'BB024', 'nama_bahan_baku' => 'Sosis', 'created_at' => now(), 'updated_at' => now()],
            ['kode_bahan' => 'BB025', 'nama_bahan_baku' => 'Baso', 'created_at' => now(), 'updated_at' => now()],
            ['kode_bahan' => 'BB026', 'nama_bahan_baku' => 'Kikil', 'created_at' => now(), 'updated_at' => now()],
            ['kode_bahan' => 'BB027', 'nama_bahan_baku' => 'Cilok', 'created_at' => now(), 'updated_at' => now()],
            ['kode_bahan' => 'BB028', 'nama_bahan_baku' => 'Cuanki', 'created_at' => now(), 'updated_at' => now()],
            ['kode_bahan' => 'BB029', 'nama_bahan_baku' => 'Tahu Sumedang', 'created_at' => now(), 'updated_at' => now()],
            ['kode_bahan' => 'BB030', 'nama_bahan_baku' => 'Cirawang', 'created_at' => now(), 'updated_at' => now()],
            ['kode_bahan' => 'BB031', 'nama_bahan_baku' => 'Cibak', 'created_at' => now(), 'updated_at' => now()],
            ['kode_bahan' => 'BB032', 'nama_bahan_baku' => 'Makaroni Hitam', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('bahan_baku')->insert($bahanBakuData);
    }
}
