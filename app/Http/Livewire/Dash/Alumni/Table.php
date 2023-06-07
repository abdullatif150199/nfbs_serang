<?php

namespace App\Http\Livewire\Dash\Alumni;

use Livewire\Component;
use App\Models\Alumni;
use App\Models\Angkatan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class Table extends DataTableComponent
{
    protected $listeners = [
        'delete'
    ];
        public function columns(): array
        {
            return [
                Column::make('angkatan','tahun_lulus', 'angkatan')
                    ->sortable()
                    ->searchable()
                    ->format(function ($value, $column, $row) {
                        return "Angkatan " . $row->angkatan . " ( " . $row->tahun_lulus . " ) "; 
                    })->asHtml(),
        
                Column::make('jumlah', 'jumlah')
                    ->sortable()
                    ->format(function ($value, $column, $row) {
                        $alumniCount = $row->alumni->count();
                        return $alumniCount . " Siswa";
                    })->asHtml(),
                Column::make('Action')
                    ->sortable()
                    ->format(function ($value, $column, $row) {
                        $alumni = $row->alumni;
                        return view('livewire.dash.alumni._actions', [
                            'data' => $row,
                            'alumni' => $alumni
                        ]);
                    })->asHtml(),
            ];
        }
    
        public function query(): Builder
        {
            return Angkatan::query()
                ->with('alumni')
                ->latest();
        }



    // public function render()
    // {
    //     return view('livewire.dash.alumni.table');
    // }

    
}
