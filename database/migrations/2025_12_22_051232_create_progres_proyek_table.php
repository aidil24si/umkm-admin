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
        Schema::create('progres_proyek', function (Blueprint $table) {
            $table->id('progres_id');
            $table->unsignedInteger('proyek_id');
            $table->unsignedInteger('tahap_id');
            $table->decimal('persen_real', 5, 2)->default(0);
            $table->date('tanggal');
            $table->text('catatan')->nullable();
            $table->timestamps();

            //foreign key proyek_id
            $table->foreign('proyek_id')
            ->references('proyek_id')
            ->on('proyek')
            ->onDelete('cascade');

            //foreign key tahap_id
            $table->foreign('tahap_id')
            ->references('tahap_id')
            ->on('tahapan_proyek')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progres_proyek');
    }
};
