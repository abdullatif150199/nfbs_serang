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
    public $sebaranKampus;
    public $title;
    public $chartData;
    public $selectedYear = [];
    public $kampusList = [];
    public $namaKampus = [];
    public array $perPageAccepted = [50];

    public function mount()
    {
        $this->tahunLulus = Alumni::distinct()->pluck('tahun_lulus')->toArray();
        $this->selectedYear = [Alumni::max('tahun_lulus')];
        $this->namaKampus = Alumni::whereIn('tahun_lulus', $this->selectedYear)->distinct()->pluck('nama_kampus')->toArray();
        $this->columnSize = request()->is('alumni*') ? 'px-2 py-1 md:px-4 md:py-2' : 'px-3 py-2 md:px-6 md:py-4';
        $this->updateKampus(); 
    }

    public function updateKampus () 
    {
       

        $this->kampusList = Alumni::whereIn('tahun_lulus', $this->selectedYear)
        ->groupBy('nama_kampus')
        ->select('nama_kampus', \DB::raw('count(*) as total'))
        ->get()
        ->sortByDesc('total')
        ->pluck('total', 'nama_kampus')
        ->toArray();
        $this->sebaranKampus = Alumni::whereIn('tahun_lulus', $this->selectedYear)
        ->groupBy('nama_kampus')
        ->select('nama_kampus', \DB::raw('count(*) as total'))
        ->get()
        ->sortByDesc('total')
        ->take(10)
        ->pluck('total', 'nama_kampus')
        ->toArray();
        foreach($this->sebaranKampus as $kampus => $jumlah) {
            $data['label'][] = $kampus;
            $data['data'][] = $jumlah;
        }
        $this->sebaranKampus = json_encode($data);

        // if (!empty($this->kampusList) && !empty($this->sebaranKampus)) {
        //     return; 
        // }
    }


    public function updatedTahunLulus()
    {  
        if (!empty($this->tahunLulus)) {
            $this->namaKampus = Alumni::where('tahun_lulus', $this->tahunLulus)
                ->distinct()
                ->pluck('nama_kampus')
                ->toArray();
        } else {
            $this->namaKampus = Alumni::distinct()->pluck('nama_kampus')->toArray();
        }
        $this->resetSelectedYear();
        $this->resetNamaKampus();
    }

    
    public function resetSelectedYear()
    {
        $this->selectedYear = [$this->tahunLulus];
        $this->updateKampus();
         $this->emitChartUpdate();
    }

    public function emitChartUpdate()
    {
        $this->emit('chartUpdate', $this->sebaranKampus);
    }

    public function resetNamaKampus()
    {
        $this->filters()['nama_kampus']->select(['' => 'Semua'] + array_combine($this->namaKampus, $this->namaKampus));
    }

    public function columns(): array
    {
        $columns = [
            Column::make('nama', 'nama')
                ->sortable()
                ->searchable()
                ->format(function ($value, $column, $row) {
                    return '<small>'.$row->nama.'</small>'; 
                })->asHtml()->addClass('w-40'),
            Column::make('jurusan', 'jurusan')
                ->searchable()
                ->sortable()
                ->format(function ($value, $column, $row) {
                    return '<small>'.$row->jurusan.'</small>'; 
                })->asHtml()->addClass('w-40'),
            Column::make('nama kampus', 'nama_kampus')
                ->searchable()
                ->sortable()
                ->format(function ($value, $column, $row) {
                    return '<small>'.$row->nama_kampus.'</small>'; 
                })->asHtml()->addClass('w-40')
           
        ];
        return $columns;
    }

    public function filters(): array
    {
        $init = ['' => 'Semua'];
        $tahunLulus = Alumni::distinct()->pluck('tahun_lulus')->toArray();
        $selectedYear = array_combine($this->selectedYear, $this->selectedYear);
        $tahunLulus_arr = $selectedYear + array_combine($tahunLulus, $tahunLulus);
        $namaKampus_arr = $init + array_combine($this->namaKampus, $this->namaKampus);
        $filters = [
            'tahun_lulus' => Filter::make('Angkatan')->select($tahunLulus_arr),
            'nama_kampus' => Filter::make('Nama kampus')->select($namaKampus_arr)
        ];
        return $filters;
    }

    public function query(): Builder
    {
        // dd($this->kampusList);
        $query = Alumni::query();
        
        if ($this->filters['tahun_lulus']) {
            $query->where('tahun_lulus', $this->filters['tahun_lulus']);
        }
        if (!empty($this->filters['nama_kampus']) && in_array($this->filters['nama_kampus'], $this->namaKampus)) {
                $query->where('nama_kampus', $this->filters['nama_kampus'])->where('tahun_lulus', $this->selectedYear);
            } else if (!empty($this->filters['nama_kampus']) && !in_array($this->filters['nama_kampus'], $this->namaKampus)) {
         $query->whereRaw('1 = 0');
        }

        if (empty($this->filters['tahun_lulus']) && empty($this->filters['nama_kampus'])) {
            $query->where('tahun_lulus', $this->selectedYear);
        } else {
            $query->latest();
        }

        return $query;
    }

}
