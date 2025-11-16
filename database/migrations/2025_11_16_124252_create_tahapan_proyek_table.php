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
        Schema::create('tahapan_proyek', function (Blueprint $table) {
            $table->increments('tahap_id');
            $table->unsignedInteger('proyek_id');
            $table->string('nama_tahap');
            $table->decimal('target_persen', 5, 2);
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->timestamps();

            //foreign key proyek_id
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
        Schema::dropIfExists('tahapan_proyek');
    }
};
