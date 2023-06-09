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
    protected $listeners = [
        'delete'
    ];
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
    
        public function query(): Builder
        {
            return Alumni::query()->latest();
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
