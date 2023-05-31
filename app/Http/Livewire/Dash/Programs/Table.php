<?php

namespace App\Http\Livewire\Dash\Programs;

use App\Models\Program;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class Table extends DataTableComponent
{
    protected $listeners = [
        'delete'
    ];

    public function columns(): array
    {
        return [
            Column::make('Nama Program', 'name')
                ->sortable()
                ->searchable()
                ->format(function ($value, $column, $row) {
                    return view('livewire.dash.programs._name', ['data' => $row]);
                }),
            Column::make('Keterangan', 'desc_preview')
                ->sortable()
                ->searchable(),
            Column::make('Actions')
                ->format(function ($value, $column, $row) {
                    return view('livewire.dash.programs._actions', ['data' => $row]);
                }),
        ];
    }

    public function query(): Builder
    {
        return Program::query()
            ->latest();
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
        $post = Program::findOrFail($id);
        $post->delete();
    }
}
