<?php

namespace App\Http\Livewire\Dash\Alumni;

use Livewire\Component;
use App\Models\Alumni;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class Table extends DataTableComponent
{
    public $tahunLulus;
    public $namaKampus = [];

    protected $listeners = [
        'delete'
    ];

            public function mount()
        {
            $this->tahunLulus = Alumni::distinct()->pluck('tahun_lulus')->toArray();
            // $this->tahunLulus = ['2021'];
            // $this->filters['nama_kampus'] = Filter::make('Nama kampus')->select([]);
            $this->updatedTahunLulus();
        }
    
        public function columns(): array
        {
            return [
                Column::make('nama','nama')
                    ->sortable()
                    ->searchable()
                    ->format(function ($value, $column, $row) {
                        return $row->nama; 
                    })->asHtml(),
                Column::make('jurusan', 'jurusan')
                    ->searchable()
                    ->sortable()
                    ->format(function ($value, $column, $row) {
                        return $row->jurusan;
                    })->asHtml(),
                Column::make('nama kampus', 'nama_kampus')
                    ->searchable()
                    ->sortable()
                    ->format(function ($value, $column, $row) {
                        return $row->nama_kampus;
                    })->asHtml(),
                Column::make('tahun lulus', 'tahun_lulus')
                    ->searchable()
                    ->sortable()
                    ->format(function ($value, $column, $row) {
                        return $row->tahun_lulus;
                })->asHtml(),
                Column::make('Action')
                    ->sortable()
                    ->format(function ($value, $column, $row) {
                        return view('livewire.dash.alumni._actions', [
                            'data' => $row,
                        ]);
                    })->asHtml(),
            ];
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
            $letakKampus = [
                'Luar Negeri' => 'Luar Negeri', 
                'Dalam Negeri' => 'Dalam Negeri'];
            $jenisKampus = [
                    'Negeri' => 'Negeri',
                    'Swasta' => 'Swasta'];
           
                    // dd($this->tahunLulus);
            $tahunLulus_arr = $init + array_combine($tahunLulus, $tahunLulus);
            $namaKampus_arr = $init + array_combine($this->namaKampus, $this->namaKampus);
            $letakKampus_arr = $init + $letakKampus;
            $jenisKampus_arr = $init + $jenisKampus;
            
            
            $filters = [
                'tahun_lulus' => Filter::make('Angkatan')->select($tahunLulus_arr),
                'letak_kampus' => Filter::make('Letak kampus')->select($letakKampus_arr),
                'jenis_kampus' => Filter::make('Jenis kampus')->select($jenisKampus_arr),
            ];
            $filters['nama_kampus'] = Filter::make('Nama kampus')->select($namaKampus_arr);
        
            return $filters;
            
        }
    
        public function query(): Builder
        {
          
            $query = Alumni::query()->latest();
            
            if ($this->filters['tahun_lulus']) {
                $query->where('tahun_lulus', $this->filters['tahun_lulus']);
            }
            if ($this->filters['letak_kampus']) {
                $query->where('letak_kampus', $this->filters['letak_kampus']);
            }
            
            if ($this->filters['jenis_kampus']) {
                $query->where('jenis_kampus', $this->filters['jenis_kampus']);
            }

            if ($this->filters['nama_kampus']) {
                $query->where('nama_kampus', $this->filters['nama_kampus']);
            } 

            return $query;
        }

            public function deleteConfirm($id)
        {
            $this->dispatchBrowserEvent('swal:confirm', [
                'type' => 'warning',
                'title' => 'Yakin ingin menghapus?',
                'text' => '',
                'id' => $id,
                'method' => 'delete'
            ]);
        }

        public function delete($id)
        {
            $alumni = Alumni::findOrFail($id);
            $alumni->delete();
        }

}
