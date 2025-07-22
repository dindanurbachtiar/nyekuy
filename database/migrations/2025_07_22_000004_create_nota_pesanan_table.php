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
            $table->string('kode_pesanan', 50)->primary(); // Primary Key
            $table->string('nama_pelanggan', 25)->nullable();
            $table->integer('jumlah_pesanan')->nullable();
            $table->string('nama_menu', 25)->nullable(); // Ini mungkin tidak perlu jika ada foreign key ke menu
            $table->string('kode_menu', 12)->nullable(); // Foreign key to 'menu' table
            $table->string('id_pelayan', 50)->nullable(); // Foreign key to 'pelayan' table
            $table->decimal('harga_satuan', 10, 2)->comment('Harga per item');
            $table->decimal('total_harga', 10, 2)->comment('Total harga (harga_satuan * jumlah_pesanan)');
            $table->timestamp('tanggal_pesanan')->nullable()->useCurrent()->comment('Tanggal dan waktu pesanan');
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])->default('pending')->comment('Status pesanan');
            $table->timestamps(); // Laravel's default created_at and updated_at

            // Indexes
            $table->index('kode_pesanan', 'idx_nota_pesanan_kode'); // Redundant if primary key, but kept for consistency with original SQL
            $table->index('tanggal_pesanan', 'idx_nota_pesanan_tgl');

            // Foreign Keys
            $table->foreign('kode_menu')->references('kode_menu')->on('menu')->onDelete('set null');
            $table->foreign('id_pelayan')->references('id_pelayan')->on('pelayan')->onDelete('set null');
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
