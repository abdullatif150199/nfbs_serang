<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Imports\AlumniImport;
use App\Exports\AlumniExport;
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

        if($item === 'alumni') {
            $init = ['' => 'Semua'];
            $tahunLulus = Alumni::distinct()->pluck('tahun_lulus')->toArray();
            $nama_kampus = Alumni::where('tahun_lulus', $tahunLulus)->distinct()->pluck('nama_kampus')->toArray();
            $letakKampus = [
                'Luar Negeri' => 'Luar Negeri', 
                'Dalam Negeri' => 'Dalam Negeri'];
                $jenisKampus = [
                    'Negeri' => 'Negeri', 
                    'Swasta' => 'Swasta'];
            $tahunLulus_arr = $init + array_combine($tahunLulus, $tahunLulus);
            $namaKampus_arr = $init + array_combine($nama_kampus, $nama_kampus);
            $letakKampus_arr = $init + $letakKampus;
            $jenisKampus_arr = $init + $jenisKampus;
            return view('dash.website.alumni-index', [
                'listNamaKampus' => $namaKampus_arr,
                'listLetakKampus' => $letakKampus_arr,
                'listJenisKampus' => $jenisKampus_arr,
                'listTahunLulus' => $tahunLulus_arr
            ]);
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


    public function import(Request $request)
    {
        $file = $request->file('file');
        $namaFile = $file->getClientOriginalName();
        $file->move('DataAlumni', $namaFile);

        Excel::import(new AlumniImport, public_path('/DataAlumni/'.$namaFile));
        return redirect('/dashboard/alumni')->with('success', 'Data Alumni Berhasil Di Import!');
    }

    public function export(Request $request) 
    {
        // dd($request);
        $tahun = $request->input('tahun');
        dd($tahun);
        $nama_kampus = $request->nama_kampus;
        $tahun_lulus = $request->tahun_lulus;
        $letak_kampus = $request->letak_kampus;
        $jenis_kampus = $request->jenis_kampus;
       
                      
        $query = Alumni::query();

        if ($tahun_lulus && $tahun_lulus != ' ') {
            $query->where('tahun_lulus', $tahun_lulus);
        }
        if ($nama_kampus && $nama_kampus != ' ') {
            $query->where('nama_kampus', $nama_kampus);
        }
        if ($letak_kampus && $letak_kampus != ' ') {
            $query->where('letak_kampus', $letak_kampus);
        }
        if ($jenis_kampus && $jenis_kampus != ' ') {
            $query->where('jenis_kampus', $jenis_kampus);
        }
        
        $items = $query->get();
        return Excel::download(new AlumniExport($items), 'DataAlumni.xlsx');
    }
    

}
