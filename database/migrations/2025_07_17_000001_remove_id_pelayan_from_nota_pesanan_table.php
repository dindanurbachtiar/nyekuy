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
        Schema::table('nota_pesanan', function (Blueprint $table) {
            // Hapus foreign key constraint terlebih dahulu jika ada
            // Anda mungkin perlu mencari nama constraint yang benar di database Anda
            // Contoh: $table->dropForeign(['id_pelayan']);
            // Atau jika Anda tahu nama constraintnya, seperti 'nota_pesanan_id_pelayan_foreign'
            // $table->dropForeign('nota_pesanan_id_pelayan_foreign');
            
            // Jika Anda tidak yakin nama constraintnya, Anda bisa mencoba ini:
            $foreignKeys = Schema::getConnection()->getDoctrineSchemaManager()->listTableForeignKeys('nota_pesanan');
            foreach ($foreignKeys as $foreignKey) {
                if (in_array('id_pelayan', $foreignKey->getColumns())) {
                    $table->dropForeign($foreignKey->getName());
                }
            }

            // Kemudian hapus kolomnya
            $table->dropColumn('id_pelayan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nota_pesanan', function (Blueprint $table) {
            // Tambahkan kembali kolom id_pelayan jika di-rollback
            $table->string('id_pelayan', 50)->default('P001')->after('jumlah_pesanan');
            // Tambahkan kembali foreign key jika diperlukan (opsional, tergantung kebutuhan)
            // $table->foreign('id_pelayan')->references('id_pelayan')->on('pelayan')->onDelete('set null');
        });
    }
};
