<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    protected $table      = 'proyek';
    protected $primaryKey = 'proyek_id';
    protected $fillable   = [
        'kode_proyek',
        'nama_proyek',
        'tahun',
        'lokasi',
        'anggaran',
        'sumber_dana',
        'deskripsi',
    ];

    protected $casts = [
        'tahun'    => 'integer',
        'anggaran' => 'decimal:2',
    ];

    public function tahapanProyek()
    {
        return $this->hasMany(TahapanProyek::class, 'proyek_id', 'proyek_id');
    }
}
