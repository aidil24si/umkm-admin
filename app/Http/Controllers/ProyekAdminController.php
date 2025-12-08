<?php
namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Proyek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProyekAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterableColumns  = ['tahun'];
        $searchableColumns  = ['nama_proyek', 'lokasi', 'sumber_dana'];
        $data['dataProyek'] = Proyek::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(10)
            ->onEachSide(2)
            ->withQueryString();
        return view('pages.proyek.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.proyek.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $data['kode_proyek'] = $request->kode_proyek;
        $data['nama_proyek'] = $request->nama_proyek;
        $data['tahun']       = $request->tahun;
        $data['lokasi']      = $request->lokasi;
        $data['anggaran']    = $request->anggaran;
        $data['sumber_dana'] = $request->sumber_dana;
        $data['deskripsi']   = $request->deskripsi;

        Proyek::create($data);

        return redirect()->route('proyek.index')->with('success', 'Penambahan Data Berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['proyek'] = Proyek::with(['dokumen' => function ($query) {
            $query->orderBy('sort_order', 'asc');
        }])->findOrFail($id);

        return view('pages.proyek.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['dataProyek'] = Proyek::findOrFail($id);
        return view('pages.proyek.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());

        $proyek_id = $id;
        $proyek    = Proyek::findOrFail($proyek_id);

        $proyek->kode_proyek = $request->kode_proyek;
        $proyek->nama_proyek = $request->nama_proyek;
        $proyek->tahun       = $request->tahun;
        $proyek->lokasi      = $request->lokasi;
        $proyek->anggaran    = $request->anggaran;
        $proyek->sumber_dana = $request->sumber_dana;
        $proyek->deskripsi   = $request->deskripsi;

        $proyek->save();
        return redirect()->route('proyek.index')->with('success', 'Perubahan Data Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $proyek = Proyek::findOrFail($id);

        // Hapus semua dokumen terkait
        foreach ($proyek->dokumen as $dokumen) {
            $dokumen->delete();
        }

        $proyek->delete();
        return redirect()->route('proyek.index');
    }

    /**
     * Upload dokumen untuk proyek
     */
    public function uploadDokumen(Request $request, string $id)
    {
        $request->validate([
            'files'      => 'required',
            'files.*'    => 'max:2048', // Maksimal 2MB
            'captions.*' => 'nullable|string|max:255',
        ]);

        $proyek       = Proyek::findOrFail($id);
        $allowedMimes = [
            // Dokumen
            'pdf'  => 'application/pdf',
            'doc'  => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'xls'  => 'application/vnd.ms-excel',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',

            // Gambar
            'jpg'  => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jfif' => 'image/jpeg',
            'png'  => 'image/png',
            'gif'  => 'image/gif',
            'webp' => 'image/webp',
            'bmp'  => 'image/bmp',
            'svg'  => 'image/svg+xml',
            'tiff' => 'image/tiff',
            'heic' => 'image/heic',
            'heif' => 'image/heif',
        ];

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $index => $file) {
                // 🔹 Validasi berdasarkan ekstensi file
                $allowedExtensions = array_keys($allowedMimes);
                if (! in_array(strtolower($file->getClientOriginalExtension()), $allowedExtensions)) {
                    continue; // Lewati file jika tipe ekstensi tidak diperbolehkan
                }

                // Validasi tipe file
                if (! in_array($file->getMimeType(), $allowedMimes)) {
                    continue; // Lewati file yang tidak valid
                }

                // Generate nama file unik
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension    = $file->getClientOriginalExtension();
                $fileName     = Str::slug($originalName) . '_' . time() . '_' . Str::random(5) . '.' . $extension;

                // Simpan file
                $file->storeAs('proyek_files', $fileName, 'public');

                // Simpan ke database
                Media::create([
                    'ref_table'  => 'proyek',
                    'ref_id'     => $proyek->proyek_id,
                    'file_name'  => $fileName,
                    'caption'    => $request->captions[$index] ?? null,
                    'mime_type'  => $file->getMimeType(),
                    'sort_order' => Media::where('ref_table', 'proyek')
                        ->where('ref_id', $proyek->proyek_id)
                        ->max('sort_order') + 1,
                ]);
            }

            return redirect()->route('proyek.show', $id)->with('success', 'Dokumen berhasil diupload!');
        }

        return redirect()->route('proyek.show', $id)->with('error', 'Gagal upload dokumen!');
    }

    /**
     * Hapus dokumen proyek
     */
    public function hapusDokumen(string $proyekId, string $dokumenId)
    {
        $dokumen = Media::where('media_id', $dokumenId)
            ->where('ref_table', 'proyek')
            ->where('ref_id', $proyekId)
            ->firstOrFail();

        $dokumen->delete();

        return redirect()->route('proyek.show', $proyekId)->with('success', 'Dokumen berhasil dihapus!');
    }

    /**
     * Download dokumen proyek
     */
    public function downloadDokumen(string $proyekId, string $dokumenId)
    {
        $dokumen = Media::where('media_id', $dokumenId)
            ->where('ref_table', 'proyek')
            ->where('ref_id', $proyekId)
            ->firstOrFail();

        $filePath = storage_path('app/public/proyek_files/' . $dokumen->file_name);

        if (! file_exists($filePath)) {
            return redirect()->route('proyek.show', $proyekId)->with('error', 'File tidak ditemukan!');
        }

        return response()->download($filePath);
    }

    /**
     * Update caption dokumen
     */
    public function updateCaption(Request $request, string $proyekId, string $dokumenId)
    {
        $request->validate([
            'caption' => 'nullable|string|max:255',
        ]);

        $dokumen = Media::where('media_id', $dokumenId)
            ->where('ref_table', 'proyek')
            ->where('ref_id', $proyekId)
            ->firstOrFail();

        $dokumen->update(['caption' => $request->caption]);

        return redirect()->route('proyek.show', $proyekId)->with('success', 'Caption berhasil diperbarui!');
    }
}
