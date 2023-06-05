<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

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

        // Mendapatkan angkatan_id yang ada dalam tabel angkatans
        $angkatanIds = DB::table('angkatans')->pluck('id');

        foreach ($angkatanIds as $angkatanId) {
           $jumlahAlumni = 100;

            for ($i = 0; $i < $jumlahAlumni; $i++) {
                DB::table('alumnis')->insert([
                    'angkatan_id' => $angkatanId,
                    'nama' => $faker->name,
                    'program_studi' => $faker->randomElement(['Teknik Informatika', 'Akuntansi', 'Hukum']),
                    'perguruan_tinggi' => $faker->company,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
