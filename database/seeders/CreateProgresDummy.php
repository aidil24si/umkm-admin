<?php
namespace Database\Seeders;

use App\Models\ProgresProyek;
use App\Models\Proyek;
use App\Models\TahapanProyek;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CreateProgresDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Kumpulan catatan Bahasa Indonesia
        $catatanIndonesia = [
            'Pekerjaan berjalan sesuai dengan rencana',
            'Progres lapangan menunjukkan hasil yang baik',
            'Pelaksanaan tahap ini hampir selesai',
            'Terdapat kendala kecil namun masih dapat dikendalikan',
            'Pekerjaan dilakukan sesuai spesifikasi teknis',
            'Cuaca cukup mendukung pelaksanaan proyek',
            'Koordinasi dengan pihak terkait berjalan lancar',
            'Material telah tersedia di lokasi proyek',
            'Tenaga kerja mencukupi untuk tahap ini',
            'Proyek berjalan sesuai jadwal yang ditentukan',
            'Dilakukan pengecekan kualitas pekerjaan',
            'Tidak ditemukan hambatan berarti di lapangan',
        ];

        $proyekList = Proyek::with('tahapanProyek')->get();

        if ($proyekList->isEmpty()) {
            $this->command->warn('Tabel proyek masih kosong.');
            return;
        }

        foreach ($proyekList as $proyek) {

            if ($proyek->tahapanProyek->isEmpty()) {
                continue;
            }

            foreach ($proyek->tahapanProyek as $tahap) {

                $jumlahProgres  = rand(1, 3);
                $persenTerakhir = 0;

                for ($i = 0; $i < $jumlahProgres; $i++) {

                    $persenTerakhir += rand(5, 30);
                    if ($persenTerakhir > $tahap->target_persen) {
                        $persenTerakhir = $tahap->target_persen;
                    }

                    ProgresProyek::create([
                        'proyek_id'   => $proyek->proyek_id,
                        'tahap_id'    => $tahap->tahap_id,
                        'persen_real' => $persenTerakhir,
                        'tanggal'     => $faker->dateTimeBetween(
                            $tahap->tgl_mulai,
                            $tahap->tgl_selesai ?? 'now'
                        )->format('Y-m-d'),
                        'catatan'     => $faker->optional()->randomElement($catatanIndonesia),
                    ]);
                }
            }
        }
    }
}
