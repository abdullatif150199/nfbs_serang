<?php

namespace App\Http\Livewire\Dash\Popups;

use App\Models\Popup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class Table extends DataTableComponent
{
    protected $listeners = [
        'delete', 'changeStatus'
    ];

    public function columns(): array
    {
        return [
            Column::make('Konten')
                ->format(function ($value, $column, $row) {
                    return view('livewire.dash.popups.content', ['data' => $row]);
                })->asHtml(),
            Column::make('Status')
                ->format(function ($value, $column, $row) {
                    return view('livewire.dash.popups.status', ['data' => $row]);
                }),
            Column::make('Actions')
                ->format(function ($value, $column, $row) {
                    return view('livewire.dash.popups.actions', ['data' => $row]);
                }),
        ];
    }

    public function query(): Builder
    {
        return Popup::query()
            ->latest();
    }

    public function confirm($id, $method, $message)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => $message,
            'text' => '',
            'id' => $id,
            'method' => $method
        ]);
    }

    public function changeStatus($id)
    {
        $popup = Popup::findOrFail($id);
        $popup->status = $popup->status === 'show' ? 'hide' : 'show';
        $popup->save();
    }

    public function delete($id)
    {
        $popup = Popup::findOrFail($id);
        $image = $popup->image;
        $destination = config('cms.image.popup_directory');
        $imagePath = $destination . '/' . $image;
        $ext = substr(strrchr($image, '.'), 1);
        $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $image);
        $thumbnailPath = $destination . '/' . $thumbnail;

        if (Storage::exists($imagePath)) {
            Storage::delete($imagePath);
        }
        if (Storage::exists($thumbnailPath)) {
            Storage::delete($thumbnailPath);
        }

        $popup->delete();
    }
}
