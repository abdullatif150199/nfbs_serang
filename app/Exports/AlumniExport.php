<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;

class AlumniExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $items;

    public function __construct($items)
    {
        $this->items = $items;
    }

        public function headings(): array
    {
        return [
            'NAMA',
            'JURUSAN',
            'NAMA KAMPUS',
            'TAHUN LULUS',
            'LETAK KAMPUS',
            'JENIS KAMPUS'
        ];
    }

    public function collection()
    {
        dd($this->items);
        $data = [];

        foreach ($this->items as $item) {
    
                $data[] = [
                    $item->nama,
                    $item->jurusan,
                    $item->nama_kampus,
                    $item->tahun_lulus,
                    $item->letak_kampus,
                    $item->jenis_kampus,
                ];
        }

        return new Collection($data);
    }
    
}
