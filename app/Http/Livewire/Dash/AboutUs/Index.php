<?php

namespace App\Http\Livewire\Dash\AboutUs;

use App\Models\About;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $about = About::latest()->first();

        return view('livewire.dash.about-us.index', [
            'about' => $about
        ]);
    }
}
