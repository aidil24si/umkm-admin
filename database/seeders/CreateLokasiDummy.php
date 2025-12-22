<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\LokasiProyek;
use App\Models\Proyek;

class CreateLokasiDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil semua proyek
        $proyeks = Proyek::all();

        if ($proyeks->isEmpty()) {
            $this->command->warn('Seeder LokasiProyek dilewati, tabel proyek kosong.');
            return;
        }

        foreach ($proyeks as $proyek) {

            // Skip jika proyek sudah punya lokasi
            if ($proyek->lokasiProyek()->exists()) {
                continue;
            }

            $lat = $faker->latitude(-11, 6);
            $lng = $faker->longitude(95, 141);

            LokasiProyek::create([
                'proyek_id' => $proyek->proyek_id,
                'lat'       => $lat,
                'lng'       => $lng,
                'geojson'   => [
                    'type' => 'Point',
                    'coordinates' => [$lng, $lat],
                    'alamat' => $faker->address,
                    'kota' => $faker->city,
                    'provinsi' => $faker->state,
                ],
            ]);
        }
    }
}
