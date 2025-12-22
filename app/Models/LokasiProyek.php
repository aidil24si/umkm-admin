<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Contracts\Database\Eloquent\Builder;

class LokasiProyek extends Model
{
    protected $table = 'lokasi_proyek';
    protected $primaryKey = 'lokasi_id';
    protected $fillable = [
        'proyek_id',
        'lat',
        'lng',
        'geojson',
    ];

    protected $casts = [
        'lat' => 'decimal:8',
        'lng' => 'decimal:8',
        'geojson' => 'array',
    ];

    /**
     * Relasi ke Proyek
     */
    public function proyek(): BelongsTo
    {
        return $this->belongsTo(Proyek::class, 'proyek_id', 'proyek_id');
    }

    /**
     * Relasi ke Media untuk dokumen/foto lokasi
     */
    public function dokumen(): HasMany
    {
        return $this->hasMany(Media::class, 'ref_id', 'lokasi_id')
                    ->where('ref_table', 'lokasi_proyek')
                    ->orderBy('sort_order', 'asc');
    }

    /**
     * Scope untuk filtering
     */
    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }

    /**
     * Scope untuk searching
     */
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

    /**
     * Scope untuk relasi proyek
     */
    public function scopeWithProyek($query)
    {
        return $query->with('proyek');
    }
}
