<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use Illuminate\Http\Request;
use App\Models\TahapanProyek;

class TahapanProyekAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dataTahapan'] = TahapanProyek::all();
        return view('pages.tahapan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['dataProyek'] = Proyek::all();
        return view('pages.tahapan.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $data['proyek_id'] = $request->proyek_id;
        $data['nama_tahap'] = $request->nama_tahap;
        $data['target_persen'] = $request->target_persen;
        $data['tgl_mulai'] = $request->tgl_mulai;
        $data['tgl_selesai'] = $request->tgl_selesai;

        TahapanProyek::create($data);

        return redirect()->route('tahapan.index')->with('success', 'Penambahan Data Tahapan Berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['dataTahapan'] = TahapanProyek::findOrFail($id);
        $data['dataProyek'] = Proyek::all();
        return view('pages.tahapan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());

        $tahapan_id = $id;
        $tahapan = TahapanProyek::findOrFail($tahapan_id);

        $tahapan->proyek_id = $request->proyek_id;
        $tahapan->nama_tahap = $request->nama_tahap;
        $tahapan->target_persen = $request->target_persen;
        $tahapan->tgl_mulai = $request->tgl_mulai;
        $tahapan->tgl_selesai = $request->tgl_selesai;

        $tahapan->save();
        return redirect()->route('tahapan.index')->with('success', 'Perubahan Data Tahapan Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tahapan = TahapanProyek::findOrFail($id);
        $tahapan->delete();
        return redirect()->route('tahapan.index');
    }
}
