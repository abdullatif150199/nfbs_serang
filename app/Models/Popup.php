<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Popup extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'type', 'frequency', 'url', 'status'];

    public function getPopupUrlAttribute($value)
    {
        if ($this->type == 'image') {
            $imageUrl = null;

            if (!is_null($this->content)) {
                $directory = config('cms.image.popup_directory');
                $imagePath = Storage::exists("{$directory}/" . $this->content);

                if ($imagePath) {
                    $imageUrl = Storage::url("{$directory}/" . $this->content);
                }
            }

            return $imageUrl;
        } else {
            $imageUrl = $this->content;
            return $imageUrl;
        }
    }

    public function getPopupThumbUrlAttribute($value)
    {
        $imageUrl = $this->content;
        if ($this->type == 'image') {
            if (!is_null($this->content)) {
                $directory = config('cms.image.popup_directory');
                $ext = substr(strrchr($this->content, '.'), 1);
                $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $this->content);
                $imagePath = Storage::exists("{$directory}/" . $thumbnail);

                if ($imagePath) {
                    $imageUrl = Storage::url("{$directory}/" . $thumbnail);
                }
            }
        }

        return $imageUrl;
    }
}
