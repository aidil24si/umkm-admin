<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TahapanProyek extends Model
{
    protected $table      = 'tahapan_proyek';
    protected $primaryKey = 'tahap_id';
    protected $fillable   = [
        'proyek_id',
        'nama_tahap',
        'target_persen',
        'tgl_mulai',
        'tgl_selesai',
    ];

    protected $casts = [
        'target_persen' => 'decimal:2',
        'tgl_mulai'     => 'date',
        'tgl_selesai'   => 'date',
    ];

    /**
     * Get the proyek that owns the tahapan proyek.
     */
    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'proyek_id', 'proyek_id');
    }
}
