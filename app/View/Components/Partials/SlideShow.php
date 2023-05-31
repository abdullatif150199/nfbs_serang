<?php

namespace App\View\Components\Partials;

use App\Models\Slider;
use Illuminate\View\Component;

class SlideShow extends Component
{
    public $sliders;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->sliders = Slider::query()
            ->select(['title', 'image', 'url'])
            ->latest('id')
            ->take(5)
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.partials.slide-show');
    }
}
