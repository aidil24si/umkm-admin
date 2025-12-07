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
        Schema::create('media', function (Blueprint $table) {
            $table->increments('media_id');
            $table->string('ref_table', 50); // 'proyek' untuk dokumen proyek
            $table->integer('ref_id'); // ID proyek
            $table->string('file_name', 255); // Nama file yang disimpan
            $table->string('caption', 255)->nullable(); // Deskripsi singkat file
            $table->string('mime_type', 100); // Jenis MIME file
            $table->integer('sort_order')->default(0); // Urutan tampilan
            $table->timestamps();

            // Index untuk performa query
            $table->index(['ref_table', 'ref_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
