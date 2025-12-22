<?php
namespace App\Http\Controllers;

use App\Models\Kontraktor;
use App\Models\Proyek;
use Illuminate\Http\Request;

class KontraktorAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterableColumns = ['proyek_id', 'nama'];
        $searchColumns = ['nama', 'penanggung_jawab', 'kontak', 'alamat'];

        $dataKontraktor = Kontraktor::with('proyek')
            ->filter($request, $filterableColumns)
            ->search($request, $searchColumns)
            ->latest()
            ->paginate(10);

        $dataProyek = Proyek::all();

        return view('pages.kontraktor-proyek.index', compact('dataKontraktor', 'dataProyek'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dataProyek = Proyek::all();
        return view('pages.kontraktor-proyek.create', compact('dataProyek'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'proyek_id' => 'required|exists:proyek,proyek_id',
            'nama' => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'kontak' => 'required|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        Kontraktor::create($request->all());

        return redirect()->route('kontraktor.index')
            ->with('success', 'Data kontraktor berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dataKontraktor = Kontraktor::findOrFail($id);
        $dataProyek = Proyek::all();

        return view('pages.kontraktor-proyek.edit', compact('dataKontraktor', 'dataProyek'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'proyek_id' => 'required|exists:proyek,proyek_id',
            'nama' => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'kontak' => 'required|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        $kontraktor = Kontraktor::findOrFail($id);
        $kontraktor->update($request->all());

        return redirect()->route('kontraktor.index')
            ->with('success', 'Data kontraktor berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kontraktor = Kontraktor::findOrFail($id);
        $kontraktor->delete();

        return redirect()->route('kontraktor.index')
            ->with('success', 'Data kontraktor berhasil dihapus!');
    }
}
