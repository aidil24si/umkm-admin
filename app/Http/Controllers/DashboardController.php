<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'username' => 'Farel',
            'role' => 'Admin',
            'last_login' => date('Y-m-d H:i:s'),
            'list_proyek' => [
                [
                    'kode_proyek' => 'PROJ-001',
                    'nama_proyek' => 'Pembangunan Gedung Sekolah',
                    'tahun' => 2024,
                    'lokasi' => 'Jakarta Selatan',
                    'anggaran' => 2500000000,
                    'sumber_dana' => 'APBD',
                    'deskripsi' => 'Pembangunan gedung sekolah 3 lantai dengan fasilitas lengkap'
                ],
                [
                    'kode_proyek' => 'PROJ-002',
                    'nama_proyek' => 'Jaringan Irigasi Pertanian',
                    'tahun' => 2023,
                    'lokasi' => 'Bandung Barat',
                    'anggaran' => 1750000000,
                    'sumber_dana' => 'APBN',
                    'deskripsi' => 'Pembangunan jaringan irigasi untuk lahan pertanian seluas 50 hektar'
                ],
                [
                    'kode_proyek' => 'PROJ-003',
                    'nama_proyek' => 'Renovasi Puskesmas',
                    'tahun' => 2024,
                    'lokasi' => 'Surabaya',
                    'anggaran' => 900000000,
                    'sumber_dana' => 'APBD',
                    'deskripsi' => 'Renovasi total bangunan puskesmas dan penambahan fasilitas kesehatan'
                ]
            ]
        ];

        return view('dashboard-admin', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}



