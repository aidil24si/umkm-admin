<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CreateTahapanDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Daftar nama tahapan proyek
        $namaTahapan = [
            'Perencanaan Awal',
            'Penyusunan Dokumen',
            'Appraisal dan Persetujuan',
            'Pengadaan Barang/Jasa',
            'Pelaksanaan Konstruksi',
            'Pengawasan dan Monitoring',
            'Serah Terima Pekerjaan',
            'Penyelesaian Akhir',
        ];

        // Ambil semua proyek yang sudah ada
        $proyeks = DB::table('proyek')->get();

        foreach ($proyeks as $proyek) {
            // Setiap proyek akan memiliki 4 tahapan (jumlah tetap)
            $tahapanProyek = [];
            $currentDate   = $faker->dateTimeBetween($proyek->tahun . '-01-01', $proyek->tahun . '-06-30');

            foreach (range(1, 1) as $tahapKe) {
                $namaTahap    = $namaTahapan[$tahapKe - 1];
                $targetPersen = $tahapKe * 25; // 25%, 50%, 75%, 100%

                // Tanggal selesai = tanggal mulai + 1-2 bulan
                $tglSelesai = $faker->dateTimeBetween(
                    $currentDate->format('Y-m-d') . ' +1 month',
                    $currentDate->format('Y-m-d') . ' +2 months'
                );

                $tahapanProyek[] = [
                    'proyek_id'     => $proyek->proyek_id,
                    'nama_tahap'    => $namaTahap,
                    'target_persen' => $targetPersen,
                    'tgl_mulai'     => $currentDate->format('Y-m-d'),
                    'tgl_selesai'   => $tglSelesai->format('Y-m-d'),
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ];

                // Tanggal mulai tahap berikutnya = tanggal selesai + 1 minggu
                $currentDate = $faker->dateTimeBetween(
                    $tglSelesai->format('Y-m-d') . ' +1 week',
                    $tglSelesai->format('Y-m-d') . ' +2 weeks'
                );
            }

            // Insert semua tahapan untuk proyek ini
            DB::table('tahapan_proyek')->insert($tahapanProyek);
        }
    }
}
