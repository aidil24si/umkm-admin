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
        Schema::create('ulasan', function (Blueprint $table) {
            $table->bigIncrements('ulasan_id');
            $table->unsignedBigInteger('produk_id');
            $table->unsignedBigInteger('warga_id');
            $table->tinyInteger('rating'); // contoh: 1–5
            $table->text('komentar')->nullable();
            $table->timestamps();

            // Foreign Key ke produk
            $table->foreign('produk_id')
                  ->references('produk_id')
                  ->on('produk')
                  ->onDelete('cascade');

            // Foreign Key ke warga
            $table->foreign('warga_id')
                  ->references('warga_id')
                  ->on('warga')
                  ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ulasan');
    }
};
