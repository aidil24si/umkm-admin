<?php
namespace App\Http\Controllers;

use App\Models\LokasiProyek;
use App\Models\Media;
use App\Models\Proyek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LokasiController extends Controller
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
}
