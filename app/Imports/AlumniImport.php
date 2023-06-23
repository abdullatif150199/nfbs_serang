<?php

namespace App\Imports;

use App\Models\Alumni;
use Maatwebsite\Excel\Concerns\ToModel;

class AlumniImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Alumni([
                'nama' => $row[1],
                'jurusan' => $row[2],
                'nama_kampus' => $row[3],
                'jenis_kampus' => $row[4],
                'tahun_lulus' => $row[5],
        ]);
    }
}
