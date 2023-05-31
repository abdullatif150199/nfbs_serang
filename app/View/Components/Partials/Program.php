<?php

namespace App\View\Components\Partials;

use App\Models\Program as ModelsProgram;
use Illuminate\View\Component;

class Program extends Component
{
    public $programs;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->programs = ModelsProgram::select(['name', 'slug', 'desc_preview'])->take(6)->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.partials.program');
    }
}
