<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->string('kode_transaksi', 50)->primary(); // ID unik transaksi
            $table->date('tgl_bayar')->nullable(); // Tanggal bayar
            $table->decimal('total_bayar', 15, 2)->nullable(); // Total semua pesanan
            $table->string('kode_pesanan')->nullable();
            $table->string('id_pelayan', 50)->nullable(); // Foreign Key
            $table->decimal('jumlah_bayar', 15, 2)->nullable(); // Uang dibayarkan pelanggan
            $table->decimal('kembalian', 15, 2)->default(0.00); // Kembalian
            $table->string('metode_bayar', 255)->default('tunai'); // cash, qris, dll
            $table->enum('status', ['pending', 'completed', 'failed'])->default('completed');
            $table->timestamps();

            // Foreign Keys
            $table->foreign('kode_pesanan')->references('kode_pesanan')->on('nota_pesanan')->onDelete('set null');
            $table->foreign('id_pelayan')->references('id_pelayan')->on('pelayan')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
