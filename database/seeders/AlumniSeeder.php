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
            $namaKampus = ['UNRAM', 'UNAIR', 'UNPAS', 'UNPAD', 'UNW', 'UNU', 'UMM'];

            for ($i = 0; $i < $jumlahAlumni; $i++) {
                DB::table('alumnis')->insert([
                    'nama' => $faker->name,
                    'jurusan' => $faker->randomElement(['Teknik Informatika', 'Akuntansi', 'Hukum']),
                    'nama_kampus' => Arr::random($namaKampus),
                    'jenis_kampus' => $faker->randomElement(['Negeri', 'Swasta']),
                    'tahun_lulus' => $faker->randomElement(['2020', '2021', '2022', '2018']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
    }
}
