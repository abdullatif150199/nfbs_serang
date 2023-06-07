<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Models\Angkatan;

class WebsiteController extends Controller
{
    public $items;

    public function __construct()
    {
        $this->items = [
            'posts',
            'slideshows',
            'categories',
            'info',
            'popups',
            'programs',
            'fasilitas',
            'about-us',
            'menu',
            'alumni',
            'alumni-show'
        ];
    }

    public function index()
    {
        return view('dash.website.posts-index');
    }

    public function views($item)
    {
        // dd($item);
        if (!in_array($item, $this->items)) {
            return abort(404);
        }

        return view("dash.website.{$item}-index", [
            'item' => $item
        ]);
    }

    public function create($item)
    {
        if (!in_array($item, $this->items)) {
            return abort(404);
        }

        return view("dash.website.{$item}-form", [
            'postId' => null,
            'title' => ucfirst($item)
        ]);
    }

    public function edit($item, $id)
    {
        if (!in_array($item, $this->items)) {
            return abort(404);
        }

        return view("dash.website.{$item}-form", [
            'postId' => $id,
            'title' => ucfirst($item)
        ]);
    }

    public function show ($item, $id) 
    {
        if (!in_array($item, $this->items)) {
            return abort(404);
        }

        $angkatan = Angkatan::where('id', $id)->first();
        return view("dash.website.{$item}-index", [
            'item' => $item,
            'id' => $id,
            'angkatan' => $angkatan

        ]);
    }

    
}
