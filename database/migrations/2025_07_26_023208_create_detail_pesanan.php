<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_pesanan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pesanan', 50); // FK ke nota_pesanan
            $table->string('kode_menu')->nullable(); // FK ke menu_minuman
            $table->string('kode_bahan')->nullable(); // FK ke bahan_baku
            $table->string('tipe_menu')->default('menu')->comment('menu atau bahan');
            $table->integer('jumlah_pesanan')->default(1);
            $table->decimal('harga_satuan', 10, 2);
            $table->decimal('total_harga', 10, 2);
            $table->timestamps();

            $table->foreign('kode_pesanan')->references('kode_pesanan')->on('nota_pesanan')->onDelete('cascade');
            $table->foreign('kode_menu')->references('kode_menu')->on('menu_minuman')->onDelete('set null');
            $table->foreign('kode_bahan')->references('kode_bahan')->on('bahan_baku')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_pesanan');
    }
};
