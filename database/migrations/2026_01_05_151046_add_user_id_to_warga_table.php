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
        Schema::table('warga', function (Blueprint $table) {
            // Tambah kolom user_id
            $table->unsignedBigInteger('user_id')->nullable()->after('warga_id');

            // Foreign key ke tabel users
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('warga', function (Blueprint $table) {
            // Hapus foreign key dulu
            $table->dropForeign(['user_id']);

            // Hapus kolom
            $table->dropColumn('user_id');
        });
    }
};
