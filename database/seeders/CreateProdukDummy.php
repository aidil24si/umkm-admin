<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CreateProdukDummy extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil semua UMKM yang sudah ada
        $umkmIds = DB::table('umkm')->pluck('umkm_id');

        // Cegah error kalau tabel umkm kosong
        if ($umkmIds->isEmpty()) {
            $this->command->warn('Seeder Produk dibatalkan: data UMKM kosong.');
            return;
        }

        // Total produk
        $jumlahProduk = 60;

        // Nama produk khas UMKM
        $namaProduk = [
            'Nasi Goreng',
            'Ayam Geprek',
            'Kopi Hitam',
            'Es Teh',
            'Roti Manis',
            'Keripik Singkong',
            'Sambal Rumahan',
            'Kue Basah',
            'Jahit Pakaian',
            'Cuci Motor'
        ];

        // Deskripsi singkat (Indonesia)
        $deskripsiSingkat = [
            'Produk rumahan.',
            'Buatan sendiri.',
            'Harga terjangkau.',
            'Kualitas terjamin.',
            'Siap digunakan.',
            'Produk lokal.'
        ];

        for ($i = 0; $i < $jumlahProduk; $i++) {
            DB::table('produk')->insert([
                'umkm_id' => $faker->randomElement($umkmIds),
                'nama_produk' => $faker->randomElement($namaProduk),
                'deskripsi' => $faker->randomElement($deskripsiSingkat),
                'harga' => $faker->numberBetween(5000, 150000),
                'stok' => $faker->numberBetween(0, 100),
                'status' => $faker->randomElement(['aktif', 'nonaktif']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
