<?php

namespace App\Models;

use App\Models\Warga;
use App\Models\Produk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ulasan extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'ulasan';

    // Primary key
    protected $primaryKey = 'ulasan_id';

    // Kolom yang bisa diisi (mass assignment)
    protected $fillable = [
        'produk_id',
        'warga_id',
        'rating',
        'komentar',
    ];

    /**
     * Relasi:
     * Ulasan dimiliki oleh satu Produk
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'produk_id');
    }

    /**
     * Relasi:
     * Ulasan ditulis oleh satu Warga
     */
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
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
