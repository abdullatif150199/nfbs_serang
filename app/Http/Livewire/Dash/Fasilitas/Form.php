<?php

namespace App\Http\Livewire\Dash\Fasilitas;

use App\Models\Facility;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $postId;
    public $facility;
    public $title;
    public $images = [];

    protected $rules = [
        'title' => 'required',
        'images.*' => 'nullable|mimes:jpg,jpeg,bmp,png'
    ];

    protected $messages = [
        'title.required' => 'Nama Fasilitas harus diisi!',
        'images.*.mimes' => 'Format gambar yang di izinkan: jpg, jpeg, bmp, png'
    ];

    public function mount($postId)
    {
        if (!is_null($postId)) {
            $this->postId = $postId;
            $this->facility = Facility::with(['subfacilities'])->find($postId);
            $this->title = $this->facility->title;
        }
    }

    public function render()
    {
        return view('livewire.dash.fasilitas.form');
    }

    public function save()
    {
        $this->validate();

        $imageNames = [];
        $destination = config('cms.image.facility_directory');
        $width = config('cms.image.thumbnail.width');
        $height = config('cms.image.thumbnail.height');
        if (count($this->images) > 0) {
            foreach ($this->images as $image) {
                $extension = $image->getClientOriginalExtension();
                $imageName = 'nfbs-' . time() . '.' . $extension;
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $imageName);

                $image->storeAs($destination, $imageName);
                Image::make($image->getRealPath())
                    ->resize($width, $height)
                    ->save(storage_path('app/' . $destination . '/' . $thumbnail));

                $imageNames[] = [
                    'image' => $imageName
                ];
            }
        }

        if (!is_null($this->postId)) {
            $facility = tap($this->facility)->update([
                'title' => $this->title
            ]);

            if (count($imageNames) > 0) {
                foreach ($facility->subfacilities as $subfacility) {
                    $imagePath = $destination . '/' . $subfacility->image;
                    $ext = substr(strrchr($subfacility->image, '.'), 1);
                    $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $subfacility->image);
                    $thumbnailPath = $destination . '/' . $thumbnail;

                    if (Storage::exists($imagePath)) {
                        Storage::delete($imagePath);
                    }

                    if (Storage::exists($thumbnailPath)) {
                        Storage::delete($thumbnailPath);
                    }
                }

                $facility->subfacilities()->delete();
            }
        } else {
            $facility = Facility::create([
                'title' => $this->title
            ]);
        }

        if (count($imageNames) > 0) {
            $facility->subfacilities()->createMany($imageNames);
        }

        return redirect()->route('dash.views', 'fasilitas');
    }
}
