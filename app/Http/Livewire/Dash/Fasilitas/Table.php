<?php

namespace App\Http\Livewire\Dash\Fasilitas;

use App\Models\Facility;
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
            Column::make('Nama Fasilitas')
                ->format(function ($value, $column, $row) {
                    return view('livewire.dash.fasilitas.name', ['data' => $row]);
                })->asHtml(),
            Column::make('Actions')
                ->format(function ($value, $column, $row) {
                    return view('livewire.dash.fasilitas.actions', ['data' => $row]);
                }),
        ];
    }

    public function query(): Builder
    {
        return Facility::query()
            ->with(['subfacilities'])
            ->oldest('priority');
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
        $facility = Facility::findOrFail($id);
        $facility->status = $facility->status === 'show' ? 'hide' : 'show';
        $facility->save();
    }

    public function delete($id)
    {
        $facility = Facility::with(['subfacilities'])->findOrFail($id);
        $destination = config('cms.image.popup_directory');
        foreach ($facility->subfacilities as $item) {
            $image = $item->image;
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
        }

        $facility->subfacilities()->delete();
        $facility->delete();
    }
}
