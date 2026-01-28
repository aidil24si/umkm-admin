<?php
namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\Media;
use App\Models\Warga;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    /**
     * Display a listing of UMKM
     */
    public function index(Request $request)
    {
        $filterableColumns = ['kategori'];
        $searchableColumns = ['nama_usaha', 'alamat', 'rt', 'rw'];
        $data['umkm']      = Umkm::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(10)
            ->onEachSide(2)
            ->withQueryString();

        return view('pages.umkm.index', $data);
    }

    /**
     * Show the form for creating a new UMKM
     */
    public function create()
    {
        $data['warga'] = Warga::all();
        return view('pages.umkm.create', $data);
    }

    /**
     * Store a newly created UMKM
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_usaha'       => 'required|string|max:150',
            'pemilik_warga_id' => 'required|exists:warga,warga_id',
            'alamat'           => 'required|string',
            'rt'               => 'required|string|max:3',
            'rw'               => 'required|string|max:3',
            'kategori'         => 'required|string|max:100',
            'kontak'           => 'required|string|max:20',
            'deskripsi'        => 'nullable|string',
        ]);

        Umkm::create($request->all());

        return redirect()
            ->route('umkm.index')
            ->with('success', 'Data UMKM berhasil ditambahkan');
    }

    /**
     * Display the specified UMKM
     */
    public function show(string $id)
    {
        $data['umkm'] = Umkm::with(['pemilik', 'produk'])
            ->findOrFail($id);

        return view('pages.umkm.show', $data);
    }

    /**
     * Show the form for editing UMKM
     */
    public function edit(string $id)
    {
        $data['umkm']  = Umkm::findOrFail($id);
        $data['warga'] = Warga::all();

        return view('pages.umkm.edit', $data);
    }

    /**
     * Update the specified UMKM
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_usaha'       => 'required|string|max:150',
            'pemilik_warga_id' => 'required|exists:warga,warga_id',
            'alamat'           => 'required|string',
            'rt'               => 'required|string|max:3',
            'rw'               => 'required|string|max:3',
            'kategori'         => 'required|string|max:100',
            'kontak'           => 'required|string|max:20',
            'deskripsi'        => 'nullable|string',
        ]);

        $umkm = Umkm::findOrFail($id);
        $umkm->update($request->all());

        return redirect()
            ->route('umkm.index')
            ->with('success', 'Data UMKM berhasil diperbarui');
    }

    /**
     * Remove the specified UMKM
     */
    public function destroy(string $id)
    {
        $umkm = Umkm::findOrFail($id);
        $umkm->delete(); // otomatis hapus produk (cascade)

        return redirect()
            ->route('umkm.index')
            ->with('success', 'Data UMKM berhasil dihapus');
    }

    public function uploadFoto(Request $request, string $id)
    {
        $request->validate([
            'files.*' => 'required|image|max:2048',
        ]);

        $umkm = Umkm::findOrFail($id);

        foreach ($request->file('files') as $index => $file) {
            $fileName = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                . '_' . time() . '_' . Str::random(5) . '.'
                . $file->getClientOriginalExtension();

            $file->storeAs('umkm_foto', $fileName, 'public');

            Media::create([
                'ref_table'  => 'umkm',
                'ref_id'     => $umkm->umkm_id,
                'file_name'  => $fileName,
                'caption'    => null,
                'mime_type'  => $file->getMimeType(),
                'sort_order' => Media::where('ref_table', 'umkm')
                    ->where('ref_id', $umkm->umkm_id)
                    ->max('sort_order') + 1,
            ]);
        }

        return back()->with('success', 'Foto UMKM berhasil diupload');
    }

    public function hapusFoto(string $umkmId, string $fotoId)
    {
        $foto = Media::where('media_id', $fotoId)
            ->where('ref_table', 'umkm')
            ->where('ref_id', $umkmId)
            ->firstOrFail();

        Storage::disk('public')->delete('umkm_foto/' . $foto->file_name);
        $foto->delete();

        return back()->with('success', 'Foto berhasil dihapus');
    }

    public function downloadFoto(string $umkmId, string $fotoId)
    {
        $foto = Media::where('media_id', $fotoId)
            ->where('ref_table', 'umkm')
            ->where('ref_id', $umkmId)
            ->firstOrFail();

        return response()->download(
            storage_path('app/public/umkm_foto/' . $foto->file_name)
        );
    }

    public function updateCaption(Request $request, string $umkmId, string $fotoId)
    {
        $request->validate(['caption' => 'nullable|string|max:255']);

        $foto = Media::where('media_id', $fotoId)
            ->where('ref_table', 'umkm')
            ->where('ref_id', $umkmId)
            ->firstOrFail();

        $foto->update(['caption' => $request->caption]);

        return back()->with('success', 'Caption diperbarui');
    }
}
