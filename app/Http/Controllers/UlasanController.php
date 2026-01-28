<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use App\Models\Produk;
use App\Models\Warga;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchableColumns = ['warga_id','produk_id'];
        $filterableColumns = ['rating'];
        $data['ulasan'] = Ulasan::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(10)
            ->onEachSide(2)
            ->withQueryString();

        return view('pages.ulasan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['produk'] = Produk::where('status', 'aktif')->get();
        $data['warga']  = Warga::all();

        return view('pages.ulasan.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produk,produk_id',
            'warga_id'  => 'required|exists:warga,warga_id',
            'rating'    => 'required|integer|min:1|max:5',
            'komentar'  => 'nullable|string',
        ]);

        Ulasan::create($request->all());

        return redirect()
            ->route('ulasan.index')
            ->with('success', 'Ulasan berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['ulasan'] = Ulasan::findOrFail($id);
        $data['produk'] = Produk::where('status', 'aktif')->get();
        $data['warga']  = Warga::all();

        return view('pages.ulasan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'produk_id' => 'required|exists:produk,produk_id',
            'warga_id'  => 'required|exists:warga,warga_id',
            'rating'    => 'required|integer|min:1|max:5',
            'komentar'  => 'nullable|string',
        ]);

        $ulasan = Ulasan::findOrFail($id);
        $ulasan->update($request->all());

        return redirect()
            ->route('ulasan.index')
            ->with('success', 'Ulasan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ulasan = Ulasan::findOrFail($id);
        $ulasan->delete();

        return redirect()
            ->route('ulasan.index')
            ->with('success', 'Ulasan berhasil dihapus');
    }
}
