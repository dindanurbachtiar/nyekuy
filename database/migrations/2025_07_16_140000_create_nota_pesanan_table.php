<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nota_pesanan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pesanan', 50)->unique();
            $table->string('nama_pelanggan', 100);
            $table->string('nama_menu', 100);
            $table->string('kode_menu', 20);
            $table->integer('jumlah_pesanan');
            $table->string('id_pelayan', 50)->default('PELAYAN001');
            $table->decimal('harga_satuan', 10, 2);
            $table->decimal('total_harga', 10, 2);
            $table->timestamp('tanggal_pesanan')->default(now());
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nota_pesanan');
    }
};
