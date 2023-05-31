<?php

namespace App\Http\Livewire\Dash\Slideshows;

use App\Models\Slider;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $postId;
    public $slider;
    public $title;
    public $url;
    public $image;
    public $image_edit = false;
    public $image_thumb;

    protected $rules = [
        'title' => 'nullable|max:100',
        'url' => 'nullable|max:250',
        'image' => 'required|mimes:jpg,jpeg,bmp,png'
    ];

    protected $messages = [
        'title.max' => 'Judul maksimal 100 karakter',
        'url.max' => 'Url maksimal 250 karakter',
        'image.required' => 'Image Slider tidak boleh kosong',
        'image.mimes' => 'Format gambar yang di izinkan: jpg, jpeg, bmp, png'
    ];

    public function mount($postId)
    {
        if (!is_null($postId)) {
            $this->postId = $postId;
            $this->slider = Slider::find($postId);
            $this->title = $this->slider->title;
            $this->url = $this->slider->url;
            $this->image = $this->slider->image_url;
            $this->image_thumb = $this->slider->image_thumb_url;
            $this->image_edit = true;
        }
    }

    public function render()
    {
        return view('livewire.dash.slideshows.form');
    }

    public function save()
    {
        $validatedData = $this->validate();

        if (!is_null($this->image)) {
            // if (method_exists($this->image, 'getClientOriginalExtension')) {
            $extension = $this->image->getClientOriginalExtension();
            $validatedData['image'] = 'nfbs-' . time() . '.' . $extension;
            $destination = config('cms.image.slider_directory');
            $width = config('cms.image.thumbnail.width');
            $height = config('cms.image.thumbnail.height');
            $this->image->storeAs($destination, $validatedData['image']);
            // }
        }

        if (!is_null($this->postId)) {
            $oldImage = $this->slider->image;
            $slider = tap($this->slider)->update($validatedData);

            if ($oldImage !== $slider->image) {
                $imagePath = $destination . '/' . $oldImage;
                $ext = substr(strrchr($oldImage, '.'), 1);
                $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $oldImage);
                $thumbnailPath = $destination . '/' . $thumbnail;

                if (Storage::exists($imagePath)) {
                    Storage::delete($imagePath);
                }
                if (Storage::exists($thumbnailPath)) {
                    Storage::delete($thumbnailPath);
                }
            }
        } else {
            $slider = Slider::create($validatedData);
        }

        if (!is_null($this->image)) {
            $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $validatedData['image']);
            Image::make($this->image->getRealPath())
                ->resize($width, $height)
                ->save(storage_path('app/' . $destination . '/' . $thumbnail));
        }

        return redirect()->route('dash.views', 'slideshows');
    }

    public function delete($id)
    {
        $slider = Slider::findOrFail($id);

        $image = $slider->image;
        $destination = config('cms.image.slider_directory');
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

        $this->image = null;
        $this->image_edit = false;
        $this->image_thumb = null;
    }
}
