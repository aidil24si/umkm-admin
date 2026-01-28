<?php
namespace App\Models;

use App\Models\Produk;
use App\Models\Pesanan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailPesanan extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'detail_pesanan';

    // Primary key
    protected $primaryKey = 'detail_id';

    // Kolom yang bisa diisi (mass assignment)
    protected $fillable = [
        'pesanan_id',
        'produk_id',
        'qty',
        'harga_satuan',
        'subtotal',
    ];

    /**
     * Relasi:
     * Detail pesanan milik satu Pesanan
     */
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id', 'pesanan_id');
    }

    /**
     * Relasi:
     * Detail pesanan milik satu Produk
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'produk_id');
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
