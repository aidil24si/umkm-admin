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
        Schema::create('kontraktor', function (Blueprint $table) {
            $table->increments('kontraktor_id');
            $table->unsignedInteger('proyek_id');
            $table->string('nama');
            $table->string('penanggung_jawab');
            $table->string('kontak', 20);
            $table->text('alamat')->nullable();
            $table->timestamps();

            // Foreign key ke tabel proyek
            $table->foreign('proyek_id')
                  ->references('proyek_id')
                  ->on('proyek')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontraktor');
    }
};
