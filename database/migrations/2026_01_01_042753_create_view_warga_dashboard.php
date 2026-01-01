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
        DB::statement("
            CREATE VIEW view_warga_dashboard AS
            SELECT
                w.warga_id,
                w.no_ktp,
                w.nama,
                w.jenis_kelamin,
                w.agama,
                w.pekerjaan,
                w.telp,
                w.email,
                w.created_at
            FROM warga w
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('DROP VIEW IF EXISTS view_warga_dashboard');
    }
};
