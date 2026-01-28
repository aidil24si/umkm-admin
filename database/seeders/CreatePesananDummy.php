<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Pesanan;
use App\Models\Warga;

class CreatePesananDummy extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil semua warga_id yang ada
        $wargaIds = Warga::pluck('warga_id');

        // Cegah error jika tabel warga kosong
        if ($wargaIds->isEmpty()) {
            $this->command->info('Seeder Pesanan dilewati karena data warga kosong.');
            return;
        }

        // Jumlah pesanan yang ingin dibuat
        $jumlahPesanan = 100;

        for ($i = 0; $i < $jumlahPesanan; $i++) {
            Pesanan::create([
                'nomor_pesanan' => 'ORD-' . strtoupper($faker->bothify('###???')) . '-' . time() . $i,
                'warga_id'      => $faker->randomElement($wargaIds),
                'total'         => $faker->numberBetween(20000, 500000),
                'status'        => $faker->randomElement([
                    'pending',
                    'diproses',
                    'dikirim',
                    'selesai',
                    'dibatalkan'
                ]),
                'alamat_kirim'  => $faker->address,
                'rt'            => str_pad($faker->numberBetween(1, 10), 3, '0', STR_PAD_LEFT),
                'rw'            => str_pad($faker->numberBetween(1, 10), 3, '0', STR_PAD_LEFT),
                'metode_bayar'  => $faker->randomElement([
                    'COD',
                    'Transfer Bank',
                    'QRIS',
                    'E-Wallet'
                ]),
            ]);
        }
    }
}
