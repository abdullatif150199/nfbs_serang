<?php

namespace App\Http\Livewire\Web;

use App\Models\Facility as ModelsFacility;
use Livewire\Component;

class Facility extends Component
{
    public $facility;
    public $listItems;

    protected $listeners = ['get-slides' => 'showSlides'];

    public function mount()
    {
        $this->facility = ModelsFacility::query()
            ->select(['id', 'priority'])
            ->with(['subfacilities:id,facility_id,image'])
            ->priority()
            ->first();
    }

    public function render()
    {
        return view('livewire.web.facility');
    }

    public function showSlides($id)
    {
        $this->facility = ModelsFacility::query()
            ->select(['id', 'priority'])
            ->with(['subfacilities:id,facility_id,image'])
            ->find($id);

        $this->dispatchBrowserEvent('DOMContentLoaded', []);
    }
}
