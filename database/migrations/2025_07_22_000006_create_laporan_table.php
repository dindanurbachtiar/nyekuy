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
        Schema::create('laporan', function (Blueprint $table) {
    $table->string('kode_laporan', 50)->primary();
    $table->date('tgl_laporan')->nullable();
    $table->decimal('pendapatan', 15, 2)->nullable();
    $table->string('kode_transaksi', 50)->unique();
    $table->timestamps();

    $table->foreign('kode_transaksi')
          ->references('kode_transaksi')
          ->on('transaksi')
          ->onDelete('cascade');

    $table->index('tgl_laporan');
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
