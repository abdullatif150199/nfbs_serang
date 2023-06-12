<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Imports\AlumniImport;
use Maatwebsite\Excel\Facades\Excel; 
use Illuminate\Http\Request;

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
            'alumni'
        ];
    }

    public function index()
    {
        return view('dash.website.posts-index');
    }

    public function views($item)
    {
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

    // public function show ($item, $id) 
    // {
    //     if (!in_array($item, $this->items)) {
    //         return abort(404);
    //     }

    //     $angkatan = Angkatan::where('id', $id)->first();
    //     return view("dash.website.{$item}-index", [
    //         'item' => $item,
    //         'id' => $id,
    //         'angkatan' => $angkatan

    //     ]);
    // }

    public function import(Request $request)
    {
        // dd($request);
        $file = $request->file('file');
        $namaFile = $file->getClientOriginalName();
        $file->move('DataAlumni', $namaFile);

        Excel::import(new AlumniImport, public_path('/DataAlumni/'.$namaFile));
        // Excel::import(new AlumniImport, 'alumni.xlsx');

        return redirect('/dashboard/alumni');
    }
}
