<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CreateWargaDummy extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID'); // Localization Indonesia

        // Agama yang umum di Indonesia
        $agama = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];

        // Daftar pekerjaan umum
        $pekerjaan = [
            'Karyawan Swasta',
            'PNS',
            'Wiraswasta',
            'Mahasiswa',
            'Pelajar',
            'Ibu Rumah Tangga',
            'Tidak Bekerja',
            'Petani',
            'Nelayan',
            'Pegawai Honorer'
        ];

        foreach (range(1, 50) as $index) {
            DB::table('warga')->insert([
                'no_ktp' => $faker->unique()->numerify('################'), // 16 digit
                'nama' => $faker->name,
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'agama' => $faker->randomElement($agama),
                'pekerjaan' => $faker->randomElement($pekerjaan),
                'telp' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
            ]);
        }
    }
}
