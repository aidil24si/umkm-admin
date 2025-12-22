<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\ProgresProyek;
use App\Models\Proyek;
use App\Models\TahapanProyek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProgresProyekAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterableColumns = ['proyek_id'];
        $searchableColumns = ['catatan'];

        $data['dataProgres'] = ProgresProyek::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->orderBy('tanggal', 'desc')
            ->paginate(10)
            ->onEachSide(2)
            ->withQueryString();

        $data['dataProyek'] = Proyek::all();
        $data['dataTahapan'] = TahapanProyek::all();

        return view('pages.progres-proyek.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['dataProyek'] = Proyek::all();
        $data['dataTahapan'] = TahapanProyek::all();
        return view('pages.progres-proyek.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'proyek_id' => 'required|exists:proyek,proyek_id',
            'tahap_id' => 'required|exists:tahapan_proyek,tahap_id',
            'persen_real' => 'required|numeric|min:0|max:100',
            'tanggal' => 'required|date',
            'catatan' => 'nullable|string',
        ]);

        ProgresProyek::create([
            'proyek_id' => $request->proyek_id,
            'tahap_id' => $request->tahap_id,
            'persen_real' => $request->persen_real,
            'tanggal' => $request->tanggal,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('progres.index')->with('success', 'Penambahan Data Berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['progres'] = ProgresProyek::with(['proyek', 'tahapan', 'foto' => function ($query) {
            $query->orderBy('sort_order', 'asc');
        }])->findOrFail($id);

        return view('pages.progres-proyek.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['progres'] = ProgresProyek::findOrFail($id);
        $data['dataProyek'] = Proyek::all();
        $data['dataTahapan'] = TahapanProyek::all();
        return view('pages.progres-proyek.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'proyek_id' => 'required|exists:proyek,proyek_id',
            'tahap_id' => 'required|exists:tahapan_proyek,tahap_id',
            'persen_real' => 'required|numeric|min:0|max:100',
            'tanggal' => 'required|date',
            'catatan' => 'nullable|string',
        ]);

        $progres = ProgresProyek::findOrFail($id);
        $progres->update($request->all());

        return redirect()->route('progres.index')->with('success', 'Perubahan Data Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $progres = ProgresProyek::findOrFail($id);

        // Hapus semua foto terkait
        foreach ($progres->foto as $foto) {
            // Hapus file dari storage
            Storage::delete('public/progres_proyek_files/' . $foto->file_name);
            $foto->delete();
        }

        $progres->delete();
        return redirect()->route('progres.index')->with('success', 'Data berhasil dihapus!');
    }

    /**
     * Upload foto untuk progres proyek
     */
    public function uploadFoto(Request $request, string $id)
    {
        $request->validate([
            'files' => 'required',
            'files.*' => 'image|max:2048', // Maksimal 2MB untuk gambar
            'captions.*' => 'nullable|string|max:255',
        ]);

        $progres = ProgresProyek::findOrFail($id);
        $allowedMimes = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'webp' => 'image/webp',
            'bmp' => 'image/bmp',
            'svg' => 'image/svg+xml',
            'tiff' => 'image/tiff',
            'heic' => 'image/heic',
            'heif' => 'image/heif',
        ];

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $index => $file) {
                // Validasi ekstensi
                $allowedExtensions = array_keys($allowedMimes);
                if (!in_array(strtolower($file->getClientOriginalExtension()), $allowedExtensions)) {
                    continue;
                }

                // Validasi tipe file
                if (!in_array($file->getMimeType(), $allowedMimes)) {
                    continue;
                }

                // Generate nama file unik
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileName = Str::slug($originalName) . '_' . time() . '_' . Str::random(5) . '.' . $extension;

                // Simpan file
                $file->storeAs('progres_proyek_files', $fileName, 'public');

                // Simpan ke database
                Media::create([
                    'ref_table' => 'progres_proyek',
                    'ref_id' => $progres->progres_id,
                    'file_name' => $fileName,
                    'caption' => $request->captions[$index] ?? null,
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => Media::where('ref_table', 'progres_proyek')
                        ->where('ref_id', $progres->progres_id)
                        ->max('sort_order') + 1,
                ]);
            }

            return redirect()->route('progres.show', $id)->with('success', 'Foto berhasil diupload!');
        }

        return redirect()->route('progres.show', $id)->with('error', 'Gagal upload foto!');
    }

    /**
     * Hapus foto progres proyek
     */
    public function hapusFoto(string $progresId, string $fotoId)
    {
        $foto = Media::where('media_id', $fotoId)
            ->where('ref_table', 'progres_proyek')
            ->where('ref_id', $progresId)
            ->firstOrFail();

        // Hapus file dari storage
        Storage::delete('public/progres_proyek_files/' . $foto->file_name);
        $foto->delete();

        return redirect()->route('progres.show', $progresId)->with('success', 'Foto berhasil dihapus!');
    }

    /**
     * Download foto progres proyek
     */
    public function downloadFoto(string $progresId, string $fotoId)
    {
        $foto = Media::where('media_id', $fotoId)
            ->where('ref_table', 'progres_proyek')
            ->where('ref_id', $progresId)
            ->firstOrFail();

        $filePath = storage_path('app/public/progres_proyek_files/' . $foto->file_name);

        if (!file_exists($filePath)) {
            return redirect()->route('progres.show', $progresId)->with('error', 'File tidak ditemukan!');
        }

        return response()->download($filePath);
    }

    /**
     * Update caption foto
     */
    public function updateCaption(Request $request, string $progresId, string $fotoId)
    {
        $request->validate([
            'caption' => 'nullable|string|max:255',
        ]);

        $foto = Media::where('media_id', $fotoId)
            ->where('ref_table', 'progres_proyek')
            ->where('ref_id', $progresId)
            ->firstOrFail();

        $foto->update(['caption' => $request->caption]);

        return redirect()->route('progres.show', $progresId)->with('success', 'Caption berhasil diperbarui!');
    }
}
