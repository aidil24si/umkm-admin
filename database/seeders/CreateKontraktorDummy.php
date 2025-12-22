<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Proyek;
use App\Models\Kontraktor;

class CreateKontraktorDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Faker Indonesia
        $faker = Faker::create('id_ID');

        // Ambil semua proyek
        $proyekList = Proyek::all();

        foreach ($proyekList as $proyek) {

            // Setiap proyek punya 1–5 kontraktor
            $jumlahKontraktor = rand(1, 5);

            for ($i = 0; $i < $jumlahKontraktor; $i++) {
                Kontraktor::create([
                    'proyek_id'        => $proyek->proyek_id,
                    'nama'             => 'PT ' . $faker->company,
                    'penanggung_jawab' => $faker->name,
                    'kontak'           => $faker->phoneNumber,
                    'alamat'           => $faker->address,
                ]);
            }
        }
    }
}
