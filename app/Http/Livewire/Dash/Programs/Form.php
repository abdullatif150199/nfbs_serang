<?php

namespace App\Http\Livewire\Dash\Programs;

use App\Models\Program;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Livewire\Component;

class Form extends Component
{
    public $postId;
    public $program;
    public $name;
    public $slug;
    public $desc_preview;
    public $detail;

    public function mount($postId)
    {
        if (!is_null($postId)) {
            $this->postId = $postId;
            $this->program = Program::find($postId);
            $this->name = $this->program->name;
            $this->slug = $this->program->slug;
            $this->desc_preview = $this->program->desc_preview;
            $this->detail = $this->program->detail;
        }
    }

    public function render()
    {
        return view('livewire.dash.programs.form');
    }

    public function updatedName()
    {
        $this->slug = SlugService::createSlug(Program::class, 'slug', $this->name);
    }

    public function save()
    {
        $validatedData = $this->validate();

        if (!is_null($this->postId)) {
            $this->program->update($validatedData);
        } else {
            Program::create($validatedData);
        }

        return redirect()->route('dash.views', 'programs');
    }

    protected function rules()
    {
        return [
            'name' => 'required',
            'slug' => 'required|unique:programs,slug,' . $this->postId,
            'desc_preview' => 'required',
            'detail' => 'required',
        ];
    }
}
