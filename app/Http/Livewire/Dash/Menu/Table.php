<?php

namespace App\Http\Livewire\Dash\Menu;

use App\Models\Menu;
use App\Models\SubMenu;
use Illuminate\Database\Eloquent\Builder;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class Table extends DataTableComponent
{
    public function columns(): array
    {
        return [
            Column::make('Menu')
                ->format(function ($value, $column, $row) {
                    return "<p class='font-semibold'> $row->name </p>";
                })->asHtml(),
            Column::make('Sub Menu')
                ->format(function ($value, $column, $row) {
                    $count = $row->submenus->count();
                    return "<p class='text-center'> $count </p>";
                })->asHtml(),
            Column::make('Tipe')
                ->format(function ($value, $column, $row) {
                    $count = $row->type;
                    return "<p class='text-center'> $count </p>";
                })->asHtml(),
            Column::make('URL Link')
                ->format(function ($value, $column, $row) {
                    return "<p class='text-left'> $row->url </p>";
                })->asHtml(),
            Column::make('Actions')
                ->format(function ($value, $column, $row) {
                    return view('livewire.dash.menu.actions', ['data' => $row]);
                }),
        ];
    }

    public function query(): Builder
    {
        return Menu::query()
            ->with(['submenus'])
            ->orderBy('type');
    }
}
