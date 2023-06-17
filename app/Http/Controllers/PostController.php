<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\YouTube;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Models\Facility;
use App\Models\Program;

class PostController extends Controller
{
    protected $limit = 12;

    public function index()
    {
        return view('posts.index');
    }

    public function articles(Request $request)
    {
        $posts = Post::query()
            ->with(['category:id,title'])
            ->select(['id', 'user_id', 'category_id', 'title', 'slug', 'image', 'pinned', 'created_at'])
            ->when($request->q, function ($query) use ($request) {
                $query->where('title', 'like', "%{$request->q}%");
            })
            ->latestFirst()
            ->published()
            ->simplePaginate($this->limit);

        return view("posts.views", [
            'posts' => $posts
        ]);
    }

    public function program(Program $program)
    {
        return view("posts.program", [
            'program' => $program
        ]);
    }

    public function category(Category $category)
    {
        $posts = $category->posts()
            ->select(['id', 'user_id', 'category_id', 'title', 'slug', 'image', 'pinned', 'created_at'])
            ->latestFirst()
            ->published()
            ->simplePaginate($this->limit);

        return view("posts.views", [
            'posts' => $posts
        ]);
    }

    public function facilities(Request $request)
    {
        $facilities = Facility::when($request->q, function ($query) use ($request) {
            $query->where('title', 'like', "%{$request->q}%");
        })
            ->priority()
            ->paginate($this->limit);

        return view("blog.facilities", [
            'facilities' => $facilities
        ]);
    }

    public function subfacilities($id)
    {
        $subs = Facility::findOrFail($id);

        return $subs->subfacilities;
    }

    public function videos(Request $request)
    {
        $apikey = config('youtube.api_key');
        $channel_id = config('youtube.channel_id');
        $max_result = config('youtube.max_result'); // maksimal video yang ingin di tampilkan

        // Data value untuk get ke youtub API
        $keyword = $request->q;
        $page = $request->page;
        $video = new YouTube($apikey, $channel_id);
        $videoLists = $video->get($keyword, $page);

        return view('posts.videos', [
            'videoLists' => $videoLists
        ]);
    }

    public function author(User $author)
    {
        $authorName = $author->name;

        $posts = $author->posts()
            ->with('category')
            ->latestFirst()
            ->published()
            ->simplePaginate($this->limit);

        return view("posts.views", [
            'posts' => $posts,
            'authorName' => $authorName
        ]);
    }

    public function show(Post $post)
    {
        $post->increment('view_count');
        return view("posts.show", [
            'post' => $post
        ]);
    }

    public function rekrutmen()
    {
        return redirect()->away('https://forms.gle/H48KZE6xAzYe6dN28');
    }

    public function faq()
    {
        return view('posts.faq');
    }
}
