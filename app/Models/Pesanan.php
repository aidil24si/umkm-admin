<?php
namespace App\Models;

use App\Models\Warga;
use App\Models\DetailPesanan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pesanan extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'pesanan';

    // Primary key
    protected $primaryKey = 'pesanan_id';

    // Kolom yang bisa diisi (mass assignment)
    protected $fillable = [
        'nomor_pesanan',
        'warga_id',
        'total',
        'status',
        'alamat_kirim',
        'rt',
        'rw',
        'metode_bayar',
    ];

    /**
     * Relasi:
     * Pesanan dimiliki oleh satu Warga
     */
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class, 'pesanan_id', 'pesanan_id');
    }

    public function foto()
    {
        return $this->hasMany(Media::class, 'ref_id', 'pesanan_id')
            ->where('ref_table', 'pesanan')
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
