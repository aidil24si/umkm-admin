<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CreateUmkmDummy extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $wargaIds = DB::table('warga')->pluck('warga_id');

        if ($wargaIds->isEmpty()) {
            $this->command->warn('Seeder UMKM dibatalkan: data warga kosong.');
            return;
        }

        $jumlahUmkm = 80;

        $prefixUsaha = [
            'Warung',
            'Toko',
            'Kedai',
            'Usaha',
            'Bengkel',
            'Laundry',
            'Depot',
            'Gerai'
        ];

        $jenisUsaha = [
            'Sembako',
            'Kopi',
            'Makan',
            'Ayam Geprek',
            'Keripik',
            'Jahit',
            'Cuci Motor',
            'Roti',
            'Pecel Lele'
        ];

        $deskripsiSingkat = [
            'Usaha rumahan warga.',
            'Melayani kebutuhan harian.',
            'Usaha kecil milik warga.',
            'Menyediakan produk lokal.',
            'Melayani pelanggan sekitar.',
            'Usaha sederhana dan terjangkau.'
        ];

        for ($i = 0; $i < $jumlahUmkm; $i++) {
            $namaPemilik = $faker->firstName;

            $namaUsaha = $faker->randomElement($prefixUsaha)
                . ' '
                . $faker->randomElement($jenisUsaha)
                . ' '
                . $namaPemilik;

            DB::table('umkm')->insert([
                'nama_usaha' => $namaUsaha,
                'pemilik_warga_id' => $faker->randomElement($wargaIds),
                'alamat' => $faker->address,
                'rt' => str_pad($faker->numberBetween(1, 20), 3, '0', STR_PAD_LEFT),
                'rw' => str_pad($faker->numberBetween(1, 10), 3, '0', STR_PAD_LEFT),
                'kategori' => $faker->randomElement([
                    'Kuliner',
                    'Kerajinan',
                    'Pertanian',
                    'Fashion'
                ]),
                'kontak' => $faker->phoneNumber,
                'deskripsi' => $faker->randomElement($deskripsiSingkat),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
