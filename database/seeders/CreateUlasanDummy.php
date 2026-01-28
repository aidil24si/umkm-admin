<?php
namespace Database\Seeders;

use App\Models\Warga;
use App\Models\Produk;
use App\Models\Ulasan;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CreateUlasanDummy extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        // Ambil semua ID produk & warga
        $produkIds = Produk::pluck('produk_id')->toArray();
        $wargaIds  = Warga::pluck('warga_id')->toArray();

        // Contoh komentar singkat bahasa Indonesia
        $komentarList = [
            'Produknya bagus',
            'Kualitas sesuai harga',
            'Pengiriman cepat',
            'Pelayanan memuaskan',
            'Produk sesuai deskripsi',
            'Cukup puas',
            'Lumayan untuk harganya',
            'Rekomended',
            'Tidak mengecewakan',
            'Sangat bagus',
        ];

        foreach ($produkIds as $produkId) {

            // Acak beberapa warga untuk mengulas produk ini
            $wargaRandom = $faker->randomElements(
                $wargaIds,
                rand(1, min(5, count($wargaIds)))
            );

            foreach ($wargaRandom as $wargaId) {

                // Hindari duplikasi (produk_id + warga_id)
                if (! Ulasan::where('produk_id', $produkId)
                    ->where('warga_id', $wargaId)
                    ->exists()) {

                    Ulasan::create([
                        'produk_id' => $produkId,
                        'warga_id'  => $wargaId,
                        'rating'    => $faker->numberBetween(1, 5),
                        'komentar'  => $faker->randomElement($komentarList),
                    ]);
                }
            }
        }
    }
}
