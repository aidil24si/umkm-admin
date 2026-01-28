<?php
namespace App\Models;

use App\Models\DetailPesanan;
use App\Models\Media;
use App\Models\Ulasan;
use App\Models\Umkm;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'produk';

    // Primary key
    protected $primaryKey = 'produk_id';

    // Kolom yang bisa diisi (mass assignment)
    protected $fillable = [
        'umkm_id',
        'nama_produk',
        'deskripsi',
        'harga',
        'stok',
        'status',
    ];

    /**
     * Relasi:
     * Produk dimiliki oleh satu UMKM
     */
    public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'umkm_id', 'umkm_id');
    }

    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class, 'produk_id', 'produk_id');
    }

    public function ulasan()
    {
        return $this->hasMany(Ulasan::class, 'produk_id', 'produk_id');
    }

    public function foto()
    {
        return $this->hasMany(Media::class, 'ref_id', 'produk_id')
            ->where('ref_table', 'produk')
            ->orderBy('sort_order');
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
