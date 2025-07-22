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
        Schema::create('menu', function (Blueprint $table) {
            $table->string('kode_menu', 12)->primary();
            $table->string('nama_menu', 18)->nullable(); // Sesuai dengan varchar(18) di dump
            $table->integer('harga')->nullable(); // Sesuai dengan int di dump
            $table->string('bahan_baku', 30)->nullable(); // Kolom bahan_baku dari dump
            $table->string('kode_bahan', 12)->nullable(); // Foreign key ke bahan_baku
            $table->timestamps(); // Laravel's default created_at and updated_at

            // Foreign Key
            $table->foreign('kode_bahan')->references('kode_bahan')->on('bahan_baku')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};
