<?php

namespace App\Http\Livewire\Dash\Alumni;

use Livewire\Component;
use App\Models\Alumni;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use Illuminate\Support\Str;

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
            $this->updatedTahunLulus();
        }
    
        public function columns(): array
            {
                $columns = [
                    Column::make('nama', 'nama')
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
            $jenisKampus = [
                    'Negeri' => 'Negeri',
                    'Swasta' => 'Swasta'];
           
                    // dd($this->tahunLulus);
            $tahunLulus_arr = $init + array_combine($tahunLulus, $tahunLulus);
            $namaKampus_arr = $init + array_combine($this->namaKampus, $this->namaKampus);
            $jenisKampus_arr = $init + $jenisKampus;
            
            
            $filters = [
                'tahun_lulus' => Filter::make('Angkatan')->select($tahunLulus_arr),
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
            if ($this->filters['jenis_kampus']) {
                $query->where('jenis_kampus', $this->filters['jenis_kampus']);
            }

            if (!empty($this->filters['nama_kampus']) && in_array($this->filters['nama_kampus'], $this->namaKampus)) {
                $query->where('nama_kampus', $this->filters['nama_kampus']);
             } else if (!empty($this->filters['nama_kampus']) && !in_array($this->filters['nama_kampus'], $this->namaKampus)) {
                $query->whereRaw('1 = 0');
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
