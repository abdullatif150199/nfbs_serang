<?php

namespace App\Http\Livewire\Dash\Info;

use App\Models\InfoHeader;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.dash.info.index', [
            'info' => $this->info
        ]);
    }

    public function getInfoProperty()
    {
        return InfoHeader::latest()->first();
    }
}
