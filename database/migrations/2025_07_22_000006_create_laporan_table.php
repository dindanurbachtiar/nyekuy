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
            $table->string('kode_laporan', 50)->primary(); // Primary Key
            $table->date('tgl_laporan')->nullable();
            $table->integer('pendapatan')->nullable();
            $table->string('kode_transaksi', 50); // NOT NULL as per SQL

            $table->timestamps(); // Laravel's default created_at and updated_at

            // Unique Key (redundant if primary key, but kept for consistency with original SQL)
            $table->unique('kode_laporan');

            // Foreign Key
            $table->foreign('kode_transaksi')->references('kode_transaksi')->on('transaksi')->onDelete('cascade');
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
