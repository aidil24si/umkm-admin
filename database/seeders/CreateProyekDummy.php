<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CreateProyekDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Daftar sumber dana
        $sumberDana = [
            'APBN',
            'APBD Provinsi',
            'APBD Kabupaten/Kota',
            'Bantuan Luar Negeri',
            'Swasta',
            'CSR Perusahaan',
            'Dana Desa',
            'Hibah'
        ];

        // Daftar jenis proyek
        $jenisProyek = [
            'Pembangunan Jalan',
            'Pembangunan Jembatan',
            'Pembangunan Sekolah',
            'Pembangunan Puskesmas',
            'Pembangunan Pasar',
            'Pembangunan Drainase',
            'Pembangunan Air Bersih',
            'Pembangunan Sarana Olahraga',
            'Pembangunan Tempat Ibadah',
            'Pembangunan Balai Desa',
            'Peningkatan Jalan',
            'Rehabilitasi Gedung',
            'Pengadaan Peralatan',
            'Program Pemberdayaan Masyarakat'
        ];

        foreach (range(1, 100) as $index) {
            $tahun = $faker->numberBetween(2020, 2025);
            $anggaran = $faker->randomFloat(2, 100000000, 5000000000);

            DB::table('proyek')->insert([
                'kode_proyek' => 'PRJ' . str_pad($index, 4, '0', STR_PAD_LEFT),
                'nama_proyek' => $faker->randomElement($jenisProyek) . ' ' . $faker->city,
                'tahun' => $tahun,
                'lokasi' => 'Kelurahan ' . $faker->city . ', Kecamatan ' . $faker->citySuffix,
                'anggaran' => $anggaran,
                'sumber_dana' => $faker->randomElement($sumberDana),
                'deskripsi' => $faker->paragraph(3),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
