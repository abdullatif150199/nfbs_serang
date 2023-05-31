<?php

namespace App\View\Components\Partials;

use App\Models\Popup as ModelsPopup;
use Illuminate\View\Component;

class Popup extends Component
{
    public $popup;
    public $show = 0;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->popup = ModelsPopup::query()
            ->where('status', 'show')
            ->latest('updated_at')
            ->first();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if (!$this->popup) {
            return;
        }

        if ($this->popup->frequency == 'every') {
            $this->show = true;
        }

        if (!session()->has('popup')) {
            $this->show = true;
            session()->put('popup', $this->popup->id);
        }

        return view('components.partials.popup');
    }
}
