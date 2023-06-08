<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class AlumniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

           $jumlahAlumni = 150;

        

            $namaKampus = ['ITB', 'UGM', 'UNTIRTA', 'UNPAD', 'UI', 'TELKOM UNIVERSTY', 'BINUS'];

            for ($i = 0; $i < $jumlahAlumni; $i++) {
                DB::table('alumnis')->insert([
                    'nama' => $faker->name,
                    'jurusan' => $faker->randomElement(['Teknik Informatika', 'Akuntansi', 'Hukum']),
                    'nama_kampus' => Arr::random($namaKampus),
                    'letak_kampus' => $faker->randomElement(['Luar Negeri', 'Dalam Negeri']),
                    'kampus_milik' => $faker->randomElement(['Negeri', 'Swasta']),
                    'tahun_lulus' => $faker->randomElement(['2020', '2021', '2022']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
    }
}
