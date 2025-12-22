<?php
namespace App\Http\Controllers;

use App\Models\LokasiProyek;
use App\Models\Media;
use App\Models\Proyek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LokasiProyekAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterableColumns = ['proyek_id'];
        $searchableColumns = [];

        $data['dataLokasi'] = LokasiProyek::withProyek()
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(10)
            ->onEachSide(2)
            ->withQueryString();

        $data['dataProyek'] = Proyek::all();

        return view('pages.lokasi-proyek.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['dataProyek'] = Proyek::all();
        return view('pages.lokasi-proyek.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'proyek_id' => 'required|exists:proyek,proyek_id',
            'lat'       => 'nullable|numeric|between:-90,90',
            'lng'       => 'nullable|numeric|between:-180,180',
            'geojson'   => 'nullable|json',
        ]);

        $data = $request->only(['proyek_id', 'lat', 'lng', 'geojson']);

        LokasiProyek::create($data);

        return redirect()->route('lokasi.index')
            ->with('success', 'Lokasi proyek berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['lokasi'] = LokasiProyek::with(['proyek', 'dokumen' => function ($query) {
            $query->orderBy('sort_order', 'asc');
        }])->findOrFail($id);

        return view('pages.lokasi-proyek.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['dataLokasi'] = LokasiProyek::findOrFail($id);
        $data['dataProyek'] = Proyek::all();

        return view('pages.lokasi-proyek.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'proyek_id' => 'required|exists:proyek,proyek_id',
            'lat'       => 'nullable|numeric|between:-90,90',
            'lng'       => 'nullable|numeric|between:-180,180',
            'geojson'   => 'nullable|json',
        ]);

        $lokasi = LokasiProyek::findOrFail($id);
        $data   = $request->only(['proyek_id', 'lat', 'lng', 'geojson']);

        $lokasi->update($data);

        return redirect()->route('lokasi.index')
            ->with('success', 'Lokasi proyek berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lokasi = LokasiProyek::findOrFail($id);

        // Hapus semua dokumen terkait
        foreach ($lokasi->dokumen as $dokumen) {
            $dokumen->delete();
        }

        $lokasi->delete();

        return redirect()->route('lokasi.index')
            ->with('success', 'Lokasi proyek berhasil dihapus!');
    }

    /**
     * Upload dokumen/foto untuk lokasi proyek
     */
    public function uploadDokumen(Request $request, string $id)
    {
        $request->validate([
            'files'      => 'required',
            'files.*'    => 'max:2048',
            'captions.*' => 'nullable|string|max:255',
        ]);

        $lokasi       = LokasiProyek::findOrFail($id);
        $allowedMimes = [
            'jpg'  => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png'  => 'image/png',
            'gif'  => 'image/gif',
            'webp' => 'image/webp',
            'bmp'  => 'image/bmp',
            'svg'  => 'image/svg+xml',
            'pdf'  => 'application/pdf',
            'doc'  => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'xls'  => 'application/vnd.ms-excel',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ];

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $index => $file) {
                $allowedExtensions = array_keys($allowedMimes);
                if (! in_array(strtolower($file->getClientOriginalExtension()), $allowedExtensions)) {
                    continue;
                }

                if (! in_array($file->getMimeType(), $allowedMimes)) {
                    continue;
                }

                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension    = $file->getClientOriginalExtension();
                $fileName     = Str::slug($originalName) . '_' . time() . '_' . Str::random(5) . '.' . $extension;

                $file->storeAs('lokasi_proyek_files', $fileName, 'public');

                Media::create([
                    'ref_table'  => 'lokasi_proyek',
                    'ref_id'     => $lokasi->lokasi_id,
                    'file_name'  => $fileName,
                    'caption'    => $request->captions[$index] ?? null,
                    'mime_type'  => $file->getMimeType(),
                    'sort_order' => Media::where('ref_table', 'lokasi_proyek')
                        ->where('ref_id', $lokasi->lokasi_id)
                        ->max('sort_order') + 1,
                ]);
            }

            return redirect()->route('lokasi.show', $id)
                ->with('success', 'Dokumen berhasil diupload!');
        }

        return redirect()->route('lokasi.show', $id)
            ->with('error', 'Gagal upload dokumen!');
    }

    /**
     * Hapus dokumen lokasi proyek
     */
    public function hapusDokumen(string $lokasiId, string $dokumenId)
    {
        $dokumen = Media::where('media_id', $dokumenId)
            ->where('ref_table', 'lokasi_proyek')
            ->where('ref_id', $lokasiId)
            ->firstOrFail();

        $dokumen->delete();

        return redirect()->route('lokasi.show', $lokasiId)
            ->with('success', 'Dokumen berhasil dihapus!');
    }

    /**
     * Download dokumen lokasi proyek
     */
    public function downloadDokumen(string $lokasiId, string $dokumenId)
    {
        $dokumen = Media::where('media_id', $dokumenId)
            ->where('ref_table', 'lokasi_proyek')
            ->where('ref_id', $lokasiId)
            ->firstOrFail();

        $filePath = storage_path('app/public/lokasi_proyek_files/' . $dokumen->file_name);

        if (! file_exists($filePath)) {
            return redirect()->route('lokasi.show', $lokasiId)
                ->with('error', 'File tidak ditemukan!');
        }

        return response()->download($filePath);
    }

    /**
     * Update caption dokumen
     */
    public function updateCaption(Request $request, string $lokasiId, string $dokumenId)
    {
        $request->validate([
            'caption' => 'nullable|string|max:255',
        ]);

        $dokumen = Media::where('media_id', $dokumenId)
            ->where('ref_table', 'lokasi_proyek')
            ->where('ref_id', $lokasiId)
            ->firstOrFail();

        $dokumen->update(['caption' => $request->caption]);

        return redirect()->route('lokasi.show', $lokasiId)
            ->with('success', 'Caption berhasil diperbarui!');
    }
}
