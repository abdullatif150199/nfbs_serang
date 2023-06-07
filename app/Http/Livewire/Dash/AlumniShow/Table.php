<?php

namespace App\Http\Livewire\Dash\AlumniShow;

use Livewire\Component;

use App\Models\Alumni;
use App\Models\Angkatan;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;


class Table extends DataTableComponent
{
    public $angkatanId;
    public $alumni;
    public $search;
    public function mount($id)
    {
        if (!is_null($id)) {
            $this->angkatanId = $id;
        }

    }

    public function columns(): array
    {
        return [
            Column::make('nama', 'nama')
                ->sortable()
                ->searchable()
                ->format(function ($value, $column, $row) {
                    return $row->nama;
                })->asHtml(),
            Column::make('program studi', 'program_studi')
                ->sortable()
                ->searchable()
                ->format(function ($value, $column, $row) {
                    return $row->program_studi;
                })->asHtml(),
            Column::make('perguruan tinggi', 'perguruan_tinggi')
                ->sortable()
                ->searchable()
                ->format(function ($value, $column, $row) {
                    return $row->perguruan_tinggi;
                })->asHtml(),

            Column::make('Action')
                ->sortable()
                ->format(function ($value, $column, $row) {
                    $alumni = $row->alumni;
                    return view('livewire.dash.alumni-show._actions', [
                        'data' => $row,
                        'alumni' => $alumni
                    ]);
                })->asHtml(),
        ];
    }

    public function query(): Builder
    {
        $angkatan = Angkatan::with('alumni')
        ->where('id', $this->angkatanId)
        ->firstOrFail();

        $alumni = $angkatan->alumni()->getQuery();
        return $alumni;
    }
}
