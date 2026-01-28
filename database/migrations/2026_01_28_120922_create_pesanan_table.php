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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->bigIncrements('pesanan_id');
            $table->string('nomor_pesanan', 50)->unique();
            $table->unsignedBigInteger('warga_id');
            $table->decimal('total', 12, 2)->default(0);
            $table->enum('status', ['pending', 'diproses', 'dikirim', 'selesai', 'dibatalkan']);
            $table->text('alamat_kirim');
            $table->string('rt', 3);
            $table->string('rw', 3);
            $table->string('metode_bayar', 50);
            $table->timestamps();

            // Foreign Key
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
        Schema::dropIfExists('pesanan');
    }
};
