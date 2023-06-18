<?php

namespace App\Http\Livewire\Dash\AlumniIndex;

use Livewire\Component;
use App\Models\Alumni;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class Table extends  DataTableComponent
{
    public $tahunLulus;
    public $columnSize;

    public $namaKampus = [];

    public function mount()
    {
        $this->tahunLulus = Alumni::distinct()->pluck('tahun_lulus')->toArray();
        $this->columnSize = request()->is('alumni*') ? 'px-2 py-1 md:px-4 md:py-2' : 'px-3 py-2 md:px-6 md:py-4';
        $this->updatedTahunLulus();
    }

    public function columns(): array
    {
        $columns = [
            Column::make('nama', 'nama')
                ->sortable()
                ->searchable()
                ->format(function ($value, $column, $row) {
                    return view('livewire.dash.alumni-index.nama', [
                        'data' => $row,
                    ]);
                })->asHtml(),
            Column::make('jurusan', 'jurusan')
                ->searchable()
                ->sortable()
                ->format(function ($value, $column, $row) {
                    return view('livewire.dash.alumni-index.jurusan', [
                        'data' => $row,
                    ]);
                })->asHtml(),
            Column::make('nama kampus', 'nama_kampus')
                ->searchable()
                ->sortable()
                ->format(function ($value, $column, $row) {
                    return view('livewire.dash.alumni-index.nama-kampus', [
                        'data' => $row,
                    ]);
                })->asHtml()
           
        ];
        return $columns;
    }

    public function updatedTahunLulus()
    {  $this->namaKampus = [];
        if (!empty($this->tahunLulus)) {
            $this->namaKampus = Alumni::where('tahun_lulus', $this->tahunLulus)
                ->distinct()
                ->pluck('nama_kampus')
                ->toArray();
        } else {
            $this->namaKampus = Alumni::distinct()->pluck('nama_kampus')->toArray();
        }

        $this->resetNamaKampus();
    }

    public function resetNamaKampus()
    {
        $this->filters()['nama_kampus']->select(['' => 'Semua'] + array_combine($this->namaKampus, $this->namaKampus));
    }

    public function filters(): array
    {
        $init = ['' => 'Semua'];
        $tahunLulus = Alumni::distinct()->pluck('tahun_lulus')->toArray();
     
        // dd($this->tahunLulus);
        $tahunLulus_arr = $init + array_combine($tahunLulus, $tahunLulus);
        $namaKampus_arr = $init + array_combine($this->namaKampus, $this->namaKampus);
        
        $filters = [
            'tahun_lulus' => Filter::make('Angkatan')->select($tahunLulus_arr),
            'nama_kampus' => Filter::make('Nama kampus')->select($namaKampus_arr)
        ];
    
        return $filters;
        
    }

    public function query(): Builder
    {
        $query = Alumni::query()->latest();
    
        if ($this->filters['tahun_lulus']) {
            $query->where('tahun_lulus', $this->filters['tahun_lulus']);
        }
    
        if (!empty($this->filters['nama_kampus']) && in_array($this->filters['nama_kampus'], $this->namaKampus)) {
            $query->where('nama_kampus', $this->filters['nama_kampus']);
        } else if (!empty($this->filters['nama_kampus']) && !in_array($this->filters['nama_kampus'], $this->namaKampus)) {
            $query->whereRaw('1 = 0'); // Menampilkan data tidak ditemukan jika filter tidak valid
        }
    
        return $query;
    }
    
    
}