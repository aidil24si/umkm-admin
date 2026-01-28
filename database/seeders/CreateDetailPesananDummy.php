<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CreateDetailPesananDummy extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil semua pesanan_id
        $pesananIds = DB::table('pesanan')->pluck('pesanan_id')->toArray();

        // Ambil semua produk (id + harga)
        $produk = DB::table('produk')
            ->select('produk_id', 'harga')
            ->get();

        // Pastikan data pesanan & produk tersedia
        if (count($pesananIds) === 0 || $produk->count() === 0) {
            return;
        }

        // Jumlah detail pesanan yang ingin dibuat
        for ($i = 0; $i < 50; $i++) {

            $produkRandom = $produk->random();
            $qty = $faker->numberBetween(1, 10);
            $harga = $produkRandom->harga;
            $subtotal = $qty * $harga;

            DB::table('detail_pesanan')->insert([
                'pesanan_id'   => $faker->randomElement($pesananIds),
                'produk_id'    => $produkRandom->produk_id,
                'qty'          => $qty,
                'harga_satuan' => $harga,
                'subtotal'     => $subtotal,
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }
    }
}
