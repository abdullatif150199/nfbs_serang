<?php

namespace App\Http\Livewire\Dash\Info;

use App\Models\InfoHeader;
use Livewire\Component;

class Form extends Component
{
    public $postId;
    public $title;
    public $link;

    protected $rules = [
        'title' => 'required|max:250',
        'link' => 'nullable|max:250',
    ];

    protected $messages = [
        'title.required' => 'Judul tidak boleh kosong',
        'title.max' => 'Judul maksimal 250 karakter',
        'link.required' => 'URL read more tidak boleh kosong',
        'link.max' => 'URL readmore maksimal 250 karakter',
    ];

    public function mount($postId)
    {
        if ($postId !== null) {
            $this->fill(InfoHeader::find($postId));
        }
    }

    public function render()
    {
        return view('livewire.dash.info.form');
    }

    public function save()
    {
        $validatedData = $this->validate();

        if ($this->postId === null) {
            InfoHeader::truncate();
        }

        InfoHeader::updateOrCreate([
            'id' => $this->postId
        ], $validatedData);

        return redirect()->route('dash.views', 'info');
    }
}
