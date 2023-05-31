<?php

namespace App\Http\Livewire\Web;

use Livewire\Component;
use App\Models\Post;

class Posts extends Component
{
    public $posts;
    public $active = 'newest';

    public function mount()
    {
        $this->posts = Post::query()
            ->with(['category:id,title,slug'])
            ->select(['id', 'category_id', 'title', 'slug', 'image', 'pinned', 'published_at'])
            ->published()
            ->pinned()
            ->latestFirst()
            ->take(6)
            ->get();
    }

    public function render()
    {
        return view('livewire.web.posts');
    }

    public function popular()
    {
        $this->active = 'popular';
        $this->posts = Post::query()
            ->with(['category:id,title,slug'])
            ->select(['id', 'category_id', 'title', 'slug', 'image', 'published_at'])
            ->published()
            ->popular()
            ->take(6)
            ->get();
    }

    public function teacherNote()
    {
        $this->active = 'teacherNote';
        $this->posts = Post::query()
            ->with(['category:id,title,slug'])
            ->select(['id', 'category_id', 'title', 'slug', 'image', 'published_at'])
            ->published()
            ->teacherNote()
            ->latestFirst()
            ->take(6)
            ->get();
    }

    public function newest()
    {
        $this->active = 'newest';
        $this->posts = Post::query()
            ->with(['category:id,title,slug'])
            ->select(['id', 'category_id', 'title', 'slug', 'image', 'pinned', 'published_at'])
            ->published()
            ->pinned()
            ->latestFirst()
            ->take(6)
            ->get();
    }
}
