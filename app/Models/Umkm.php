<?php
namespace App\Models;

use App\Models\Media;
use App\Models\Produk;
use App\Models\Warga;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'umkm';

    // Primary key
    protected $primaryKey = 'umkm_id';

    // Kolom yang bisa diisi
    protected $fillable = [
        'nama_usaha',
        'pemilik_warga_id',
        'alamat',
        'rt',
        'rw',
        'kategori',
        'kontak',
        'deskripsi',
    ];

    /**
     * Relasi:
     * UMKM dimiliki oleh satu Warga
     */
    public function pemilik()
    {
        return $this->belongsTo(Warga::class, 'pemilik_warga_id', 'warga_id');
    }

    //satu UMKM bisa punya banyak produk
    public function produk()
    {
        return $this->hasMany(Produk::class, 'umkm_id', 'umkm_id');
    }

    public function foto()
    {
        return $this->hasMany(Media::class, 'ref_id', 'umkm_id')
            ->where('ref_table', 'umkm')
            ->orderBy('sort_order', 'asc');
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
