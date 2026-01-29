<?php
namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\Ulasan;
use App\Models\Umkm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $data = [
            // Statistik
            'totalUmkm'        => Umkm::count(),
            'totalProduk'      => Produk::count(),
            'totalStok'        => Produk::where('status', 'nonaktif')->sum('stok'),
            'totalNilaiProduk' => Produk::sum(DB::raw('harga * stok')),

            // Data tabel
            'umkm'             => Umkm::latest()->take(5)->get(),
            'produk'           => Produk::with('umkm')->latest()->take(5)->get(),

            // Data pesanan terbaru
            'pesanan'          => Pesanan::with('warga')
                ->latest()
                ->take(8)
                ->get(),
        ];

        $data['ratingProduk'] = Ulasan::with(['produk', 'warga'])
            ->latest() // urut terbaru
            ->take(8)  // ambil 10 ulasan terbaru, bisa diubah sesuai kebutuhan
            ->get();

        return view('pages.dashboard', $data);
    }
}
