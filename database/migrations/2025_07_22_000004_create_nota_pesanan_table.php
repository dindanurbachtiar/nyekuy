<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nota_pesanan', function (Blueprint $table) {
            $table->string('kode_pesanan', 50)->primary();
            $table->string('nama_pelanggan', 50)->nullable();
            $table->string('id_pelayan', 50)->nullable();
            $table->decimal('total_harga', 10, 2)->default(0)->comment('Total semua harga dari detail_pesanan');
            $table->timestamp('tanggal_pesanan')->useCurrent();
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();

            $table->foreign('id_pelayan')->references('id_pelayan')->on('pelayan')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nota_pesanan');
    }
};
