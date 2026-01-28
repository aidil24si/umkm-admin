<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Umkm;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchableColumns = ['nama_produk','stok'];
        $filterableColumns = ['status'];
        $data['produk'] = Produk::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(10)
            ->onEachSide(2)
            ->withQueryString();

        return view('pages.produk.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['umkm'] = Umkm::all();
        return view('pages.produk.create', $data);
    }

    /**
     * Store a newly created resource.
     */
    public function store(Request $request)
    {
        $request->validate([
            'umkm_id'     => 'required|exists:umkm,umkm_id',
            'nama_produk' => 'required|string|max:150',
            'deskripsi'   => 'nullable|string',
            'harga'       => 'required|numeric',
            'stok'        => 'required|integer|min:0',
            'status'      => 'required|in:aktif,nonaktif',
        ]);

        Produk::create($request->all());

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['produk'] = Produk::with(['umkm', 'foto'])->findOrFail($id);
        return view('pages.produk.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['produk'] = Produk::findOrFail($id);
        $data['umkm']   = Umkm::all();

        return view('pages.produk.edit', $data);
    }

    /**
     * Update the specified resource.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'umkm_id'     => 'required|exists:umkm,umkm_id',
            'nama_produk' => 'required|string|max:150',
            'deskripsi'   => 'nullable|string',
            'harga'       => 'required|numeric',
            'stok'        => 'required|integer|min:0',
            'status'      => 'required|in:aktif,nonaktif',
        ]);

        $produk = Produk::findOrFail($id);
        $produk->update($request->all());

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil diperbarui');
    }

    /**
     * Remove the specified resource.
     */
    public function destroy(string $id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil dihapus');
    }

    /* =========================
       FOTO PRODUK (MEDIA)
       ========================= */

    public function uploadFoto(Request $request, string $id)
    {
        $request->validate([
            'files.*' => 'required|image|max:2048',
        ]);

        $produk = Produk::findOrFail($id);

        foreach ($request->file('files') as $file) {
            $fileName = Str::slug(
                pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
            ) . '_' . time() . '_' . Str::random(5) . '.' .
            $file->getClientOriginalExtension();

            $file->storeAs('produk_foto', $fileName, 'public');

            Media::create([
                'ref_table'  => 'produk',
                'ref_id'     => $produk->produk_id,
                'file_name'  => $fileName,
                'caption'    => null,
                'mime_type'  => $file->getMimeType(),
                'sort_order' => Media::where('ref_table', 'produk')
                    ->where('ref_id', $produk->produk_id)
                    ->max('sort_order') + 1,
            ]);
        }

        return back()->with('success', 'Foto produk berhasil diupload');
    }

    public function hapusFoto(string $produkId, string $fotoId)
    {
        $foto = Media::where('media_id', $fotoId)
            ->where('ref_table', 'produk')
            ->where('ref_id', $produkId)
            ->firstOrFail();

        Storage::disk('public')->delete('produk_foto/' . $foto->file_name);
        $foto->delete();

        return back()->with('success', 'Foto produk berhasil dihapus');
    }

    public function downloadFoto(string $produkId, string $fotoId)
    {
        $foto = Media::where('media_id', $fotoId)
            ->where('ref_table', 'produk')
            ->where('ref_id', $produkId)
            ->firstOrFail();

        return response()->download(
            storage_path('app/public/produk_foto/' . $foto->file_name)
        );
    }

    public function updateCaption(Request $request, string $produkId, string $fotoId)
    {
        $request->validate([
            'caption' => 'nullable|string|max:255'
        ]);

        $foto = Media::where('media_id', $fotoId)
            ->where('ref_table', 'produk')
            ->where('ref_id', $produkId)
            ->firstOrFail();

        $foto->update([
            'caption' => $request->caption
        ]);

        return back()->with('success', 'Caption foto diperbarui');
    }
}
