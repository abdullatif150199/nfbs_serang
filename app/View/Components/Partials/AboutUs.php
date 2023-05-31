<?php

namespace App\View\Components\Partials;

use App\Models\About;
use Illuminate\View\Component;

class AboutUs extends Component
{
    public $about;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->about = About::query()
            ->select(['body', 'url_embed', 'url_read_more'])
            ->latest('id')
            ->first();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.partials.about-us');
    }
}
