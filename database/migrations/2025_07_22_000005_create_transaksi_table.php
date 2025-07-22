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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->string('kode_transaksi', 50)->primary();
            $table->date('tgl_bayar')->nullable();
            $table->integer('total_bayar')->nullable();
            $table->string('kode_pesanan', 50)->nullable(); // Foreign key to 'nota_pesanan' table
            $table->string('id_pelayan', 50)->nullable(); // Foreign key to 'pelayan' table
            $table->decimal('jumlah_bayar', 15, 2)->nullable();
            $table->decimal('kembalian', 15, 2)->default(0.00);
            $table->string('metode_bayar', 255)->default('tunai');
            $table->enum('status', ['pending', 'completed', 'failed'])->default('completed');
            $table->timestamps(); // Laravel's default created_at and updated_at

            // Indexes
            $table->index('kode_transaksi', 'idx_transaksi_kode'); // Redundant if primary key, but kept for consistency with original SQL
            $table->index('tgl_bayar', 'idx_transaksi_tgl_bayar');

            // Foreign Keys
            $table->foreign('kode_pesanan')->references('kode_pesanan')->on('nota_pesanan')->onDelete('set null');
            $table->foreign('id_pelayan')->references('id_pelayan')->on('pelayan')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
