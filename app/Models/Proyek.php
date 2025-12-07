<?php
namespace App\Models;

use App\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    /**
     * Relasi ke Media untuk dokumen proyek
     */
    public function dokumen(): HasMany
    {
        return $this->hasMany(Media::class, 'ref_id', 'proyek_id')
                    ->where('ref_table', 'proyek')
                    ->orderBy('sort_order', 'asc');
    }

    public function tahapanProyek()
    {
        return $this->hasMany(TahapanProyek::class, 'proyek_id', 'proyek_id');
    }

    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }

    public function scopeSearch($query, $request, array $columns)
    {
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
            });
        }
    }
}
