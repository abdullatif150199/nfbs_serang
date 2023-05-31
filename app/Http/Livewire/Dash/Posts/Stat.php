<?php

namespace App\Http\Livewire\Dash\Posts;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Stat extends Component
{
    public $posts = [];

    public function mount()
    {
        $this->posts = collect(DB::table('posts')
            ->selectRaw("COUNT(CASE WHEN published_at <= NOW() AND deleted_at IS NULL THEN 1 END) AS publish")
            ->selectRaw("COUNT(CASE WHEN published_at > NOW() AND deleted_at IS NULL THEN 1 END) AS schedule")
            ->selectRaw("COUNT(CASE WHEN published_at IS NULL AND deleted_at IS NULL THEN 1 END) AS draft")
            ->first());
    }

    public function render()
    {
        return view('livewire.dash.posts.stat');
    }
}
