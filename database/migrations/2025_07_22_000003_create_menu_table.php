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
        Schema::create('menu_minuman', function (Blueprint $table) {
            $table->string('kode_menu', 12)->primary();
            $table->string('nama_menu', 50); // Lebih fleksibel dari 18 karakter
            $table->integer('harga');
            $table->integer('stok')->default(0); // Untuk stok minuman
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_minuman');
    }
};
