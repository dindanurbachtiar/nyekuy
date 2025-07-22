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
        Schema::create('pelayan', function (Blueprint $table) {
            $table->string('id_pelayan', 50)->primary(); // Menggunakan string sebagai primary key
            $table->string('nama_pelayan', 100);
            $table->string('username', 100)->unique(); // Menambahkan kolom username
            $table->string('password'); // Menambahkan kolom password (akan disimpan dalam bentuk hash)
            $table->timestamps(); // Laravel's default created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelayan');
    }
};
