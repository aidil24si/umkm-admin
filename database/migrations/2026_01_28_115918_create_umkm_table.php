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
        Schema::create('umkm', function (Blueprint $table) {
            $table->bigIncrements('umkm_id');
            $table->string('nama_usaha', 150);
            $table->unsignedBigInteger('pemilik_warga_id');
            $table->text('alamat');
            $table->string('rt', 3);
            $table->string('rw', 3);
            $table->string('kategori', 100);
            $table->string('kontak', 50)->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            // Foreign Key
            $table->foreign('pemilik_warga_id')
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
        Schema::dropIfExists('umkm');
    }
};
