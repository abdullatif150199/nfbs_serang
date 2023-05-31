<?php

namespace App\View\Components\Partials;

use App\Models\Facility as ModelsFacility;
use Illuminate\View\Component;

class Facility extends Component
{
    public $listItems;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->listItems = ModelsFacility::query()
            ->priority()
            ->pluck('title', 'id');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.partials.facility');
    }
}
