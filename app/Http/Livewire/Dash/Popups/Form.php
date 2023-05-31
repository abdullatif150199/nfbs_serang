<?php

namespace App\Http\Livewire\Dash\Popups;

use App\Models\Popup;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $postId;
    public $type = 'image';
    public $popup;
    public $popup_text;
    public $popup_image;
    public $title;
    public $url;
    public $frequency;

    protected $rules = [
        'type' => 'required',
        'frequency' => 'required',
        'url' => 'nullable|max:250',
        'popup_text' => 'nullable|max:1000',
        'popup_image' => 'nullable|mimes:jpg,jpeg,bmp,png'
    ];

    protected $messages = [
        'type.required' => 'Tipe popup harus dipilih',
        'frequency.required' => 'Frekuensi popup harus dipilih',
        'url.max' => 'Url maksimal 250 karakter',
        'popup_text.max' => 'Konten tidak boleh lebih dari 1000 karakter',
        'popup_image.mimes' => 'Format gambar yang di izinkan: jpg, jpeg, bmp, png'
    ];

    public function mount($postId)
    {
        if (!is_null($postId)) {
            $this->postId = $postId;
            $this->popup = Popup::find($postId);
            $this->url = $this->popup->url;
            $this->type = $this->popup->type;
            $this->frequency = $this->popup->frequency;
            $this->popup_text = $this->popup->type == 'text' ? $this->popup->content : null;
            $this->popup_image = $this->popup->type == 'image' ? $this->popup->content : null;
        }
    }

    public function render()
    {
        return view('livewire.dash.popups.form');
    }

    public function save()
    {
        $validatedData = $this->validate();
        $validatedData['content'] = $validatedData['popup_text'];

        if (!is_null($this->popup_image)) {
            // if (method_exists($this->popup_image, 'getClientOriginalExtension')) {
            $extension = $this->popup_image->getClientOriginalExtension();
            $validatedData['content'] = 'nfbs-' . time() . '.' . $extension;
            $destination = config('cms.image.popup_directory');
            $width = config('cms.image.thumbnail.width');
            $height = config('cms.image.thumbnail.height');
            $this->popup_image->storeAs($destination, $validatedData['content']);
            // }
        }

        if (!is_null($this->postId)) {
            $oldImage = $this->popup->content;
            $popup = tap($this->popup)->update($validatedData);

            if ($popup->type === 'image') {
                if ($oldImage !== $popup->content) {
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
            }
        } else {
            $popup = Popup::create($validatedData);
        }

        if (!is_null($this->popup_image)) {
            $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $validatedData['content']);
            Image::make($this->popup_image->getRealPath())
                ->resize($width, $height)
                ->save(storage_path('app/' . $destination . '/' . $thumbnail));
        }

        return redirect()->route('dash.views', 'popups');
    }
}
