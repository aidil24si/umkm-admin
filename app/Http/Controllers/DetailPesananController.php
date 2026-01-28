<?php

namespace App\Http\Controllers;

use App\Models\DetailPesanan;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;

class DetailPesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchableColumns = ['qty', 'harga_satuan', 'subtotal'];
        $filterableColumns = ['pesanan_id'];

        $data['detailPesanan'] = DetailPesanan::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('pages.detail_pesanan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['pesanan'] = Pesanan::all();
        $data['produk']  = Produk::where('status', 'aktif')->get();

        return view('pages.detail_pesanan.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pesanan_id'    => 'required|exists:pesanan,pesanan_id',
            'produk_id'     => 'required|exists:produk,produk_id',
            'qty'           => 'required|integer|min:1',
            'harga_satuan'  => 'required|numeric|min:0',
        ]);

        $subtotal = $request->qty * $request->harga_satuan;

        DetailPesanan::create([
            'pesanan_id'   => $request->pesanan_id,
            'produk_id'    => $request->produk_id,
            'qty'          => $request->qty,
            'harga_satuan' => $request->harga_satuan,
            'subtotal'     => $subtotal,
        ]);

        return redirect()
            ->route('detail.index')
            ->with('success', 'Detail pesanan berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['detailPesanan'] = DetailPesanan::findOrFail($id);
        $data['pesanan']       = Pesanan::all();
        $data['produk']        = Produk::where('status', 'aktif')->get();

        return view('pages.detail_pesanan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'pesanan_id'    => 'required|exists:pesanan,pesanan_id',
            'produk_id'     => 'required|exists:produk,produk_id',
            'qty'           => 'required|integer|min:1',
            'harga_satuan'  => 'required|numeric|min:0',
        ]);

        $detailPesanan = DetailPesanan::findOrFail($id);

        $subtotal = $request->qty * $request->harga_satuan;

        $detailPesanan->update([
            'pesanan_id'   => $request->pesanan_id,
            'produk_id'    => $request->produk_id,
            'qty'          => $request->qty,
            'harga_satuan' => $request->harga_satuan,
            'subtotal'     => $subtotal,
        ]);

        return redirect()
            ->route('detail.index')
            ->with('success', 'Detail pesanan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $detailPesanan = DetailPesanan::findOrFail($id);
        $detailPesanan->delete();

        return redirect()
            ->route('detail.index')
            ->with('success', 'Detail pesanan berhasil dihapus');
    }
}
