<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Media;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PesananController extends Controller
{
    /**
     * Display listing pesanan
     */
    public function index(Request $request)
    {
        $filterableColumns = ['status', 'metode_bayar'];
        $searchableColumns = ['nomor_pesanan', 'alamat_kirim', 'rt', 'rw'];

        $data['pesanan'] = Pesanan::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->orderBy('pesanan_id', 'desc')
            ->paginate(10)
            ->onEachSide(2)
            ->withQueryString();

        return view('pages.pesanan.index', $data);
    }

    /**
     * Form tambah pesanan
     */
    public function create()
    {
        $data['warga'] = Warga::all();
        return view('pages.pesanan.create', $data);
    }

    /**
     * Simpan pesanan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomor_pesanan' => 'required|string|max:50|unique:pesanan,nomor_pesanan',
            'warga_id'      => 'required|exists:warga,warga_id',
            'total'         => 'required|numeric|min:0',
            'status'        => 'required|string|max:30',
            'alamat_kirim'  => 'required|string',
            'rt'            => 'required|string|max:3',
            'rw'            => 'required|string|max:3',
            'metode_bayar'  => 'required|string|max:50',
        ]);

        Pesanan::create($request->all());

        return redirect()
            ->route('pesanan.index')
            ->with('success', 'Pesanan berhasil ditambahkan');
    }

    /**
     * Detail pesanan + foto bukti
     */
    public function show(string $id)
    {
        $data['pesanan'] = Pesanan::with([
            'warga',
            'detailPesanan.produk',
            'foto'
        ])->findOrFail($id);

        return view('pages.pesanan.show', $data);
    }

    /**
     * Form edit pesanan
     */
    public function edit(string $id)
    {
        $data['pesanan'] = Pesanan::findOrFail($id);
        $data['warga'] = Warga::all();

        return view('pages.pesanan.edit', $data);
    }

    /**
     * Update pesanan
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'warga_id'      => 'required|exists:warga,warga_id',
            'total'         => 'required|numeric|min:0',
            'status'        => 'required|string|max:30',
            'alamat_kirim'  => 'required|string',
            'rt'            => 'required|string|max:3',
            'rw'            => 'required|string|max:3',
            'metode_bayar'  => 'required|string|max:50',
        ]);

        $pesanan = Pesanan::findOrFail($id);
        $pesanan->update($request->all());

        return redirect()
            ->route('pesanan.index')
            ->with('success', 'Pesanan berhasil diperbarui');
    }

    /**
     * Hapus pesanan + semua foto bukti
     */
    public function destroy(string $id)
    {
        $pesanan = Pesanan::findOrFail($id);

        foreach ($pesanan->foto as $foto) {
            Storage::disk('public')->delete('pesanan_bukti/' . $foto->file_name);
            $foto->delete();
        }

        $pesanan->delete();

        return redirect()
            ->route('pesanan.index')
            ->with('success', 'Pesanan berhasil dihapus');
    }

    /* =====================================================
     * FOTO BUKTI PEMBAYARAN
     * ===================================================== */

    /**
     * Upload foto bukti pembayaran
     */
    public function uploadFoto(Request $request, string $id)
    {
        $request->validate([
            'files'     => 'required',
            'files.*'   => 'image|max:2048',
            'captions.*'=> 'nullable|string|max:255',
        ]);

        $pesanan = Pesanan::findOrFail($id);

        foreach ($request->file('files') as $index => $file) {
            $fileName = Str::slug(
                    pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
                ) . '_' . time() . '_' . Str::random(5) . '.'
                . $file->getClientOriginalExtension();

            $file->storeAs('pesanan_bukti', $fileName, 'public');

            Media::create([
                'ref_table'  => 'pesanan',
                'ref_id'     => $pesanan->pesanan_id,
                'file_name'  => $fileName,
                'caption'    => $request->captions[$index] ?? null,
                'mime_type'  => $file->getMimeType(),
                'sort_order' => Media::where('ref_table', 'pesanan')
                    ->where('ref_id', $pesanan->pesanan_id)
                    ->max('sort_order') + 1,
            ]);
        }

        return back()->with('success', 'Bukti pembayaran berhasil diupload');
    }

    /**
     * Hapus foto bukti pembayaran
     */
    public function hapusFoto(string $pesananId, string $fotoId)
    {
        $foto = Media::where('media_id', $fotoId)
            ->where('ref_table', 'pesanan')
            ->where('ref_id', $pesananId)
            ->firstOrFail();

        Storage::disk('public')->delete('pesanan_bukti/' . $foto->file_name);
        $foto->delete();

        return back()->with('success', 'Foto bukti pembayaran berhasil dihapus');
    }

    /**
     * Download foto bukti pembayaran
     */
    public function downloadFoto(string $pesananId, string $fotoId)
    {
        $foto = Media::where('media_id', $fotoId)
            ->where('ref_table', 'pesanan')
            ->where('ref_id', $pesananId)
            ->firstOrFail();

        return response()->download(
            storage_path('app/public/pesanan_bukti/' . $foto->file_name)
        );
    }

    /**
     * Update caption foto
     */
    public function updateCaption(Request $request, string $pesananId, string $fotoId)
    {
        $request->validate([
            'caption' => 'nullable|string|max:255',
        ]);

        $foto = Media::where('media_id', $fotoId)
            ->where('ref_table', 'pesanan')
            ->where('ref_id', $pesananId)
            ->firstOrFail();

        $foto->update(['caption' => $request->caption]);

        return back()->with('success', 'Caption berhasil diperbarui');
    }
}
