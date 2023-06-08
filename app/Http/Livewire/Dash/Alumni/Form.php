<?php

namespace App\Http\Livewire\Dash\Alumni;

use Livewire\Component;
use App\Models\Alumni;

class Form extends Component
{
    use WithFileUploads;

    public $id;
    public $alumni;
    public $nama;
    public $jurusan;
    public $nama_kampus;
    public $letak_kampus;
    public $kampus_milik;
    public $tahun_lulus;
    public $image;
    public $published_at;
  

    protected $listeners = [
        'refreshCategory'
    ];

    public function mount($id)
    {
        if (!is_null($id)) {
            $this->id = $id;
            $this->alumni = Alumni::find($id);
            $this->nama = $this->alumni->nama;
            $this->jurusan = $this->alumni->jurusan;
            $this->nama_kampus = $this->alumni->nama_kampus;
            $this->kampus_milik = $this->alumni->kampus_milik;
            $this->tahun_lulus = $this->alumni->tahun_lulus;
            $this->image = $this->alumni->image;
            // $this->published_at = !is_null($this->post->published_at) ? $this->post->published_at->format('Y-m-d') : null;
            // $this->image_edit = $this->post->image_url;
        }

    }

    public function save()
    {
        $validatedData = $this->validate();
        // $validatedData['published_at'] = !empty($this->published_at) ? $this->published_at : null;
        // $length = config('cms.excerpt.length');
        // $end    = config('cms.excerpt.end');
        // $validatedData['excerpt'] = str_excerpt(strip_tags($this->body), $length, $end);

        if (!is_null($this->image)) {
        //     if (method_exists($this->image, 'getClientOriginalExtension')) {
        //     $extension = $this->image->getClientOriginalExtension();
        //     $validatedData['image'] = 'nfbs-' . time() . '.' . $extension;
        //     $destination = config('cms.image.directory');
        //     $width = config('cms.image.thumbnail.width');
        //     $height = config('cms.image.thumbnail.height');
        //     $this->image->storeAs($destination, $validatedData['image']);
            
        // }

        if (!is_null($this->id)) {
            
                $this->post->title = $validatedData['title'];
                $this->post->slug = $validatedData['slug'];
                $this->post->body = $validatedData['body'];
                $this->post->category_id = $validatedData['category_id'];
                $this->post->published_at = $validatedData['published_at'];
                $post = $this->post->save();
            }
        } else {
            $post = auth()->user()->posts()->create($validatedData);
        }

        if (!is_null($this->image)) {
            $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $validatedData['image']);
            Image::make($this->image->getRealPath())
                ->resize($width, $height)
                ->save(storage_path('app/' . $destination . '/' . $thumbnail));
        }

        return redirect()->route('dash.index');
    }

    public function refreshCategory()
    {
        $this->categories = Category::pluck('title', 'id')->toArray();
    }

    protected function rules()
    {
        return [
            'title' => 'required',
            'slug' => 'required|unique:posts,slug,' . $this->postId,
            // 'excerpt' => 'required',
            'body' => 'required',
            'published_at' => 'nullable|date_format:Y-m-d',
            'category_id' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,bmp,png'
        ];
    }
    public function render()
    {
        return view('livewire.dash.alumni.form');
    }
}
