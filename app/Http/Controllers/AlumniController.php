<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlumniController extends Controller
{
    public function index ()
    {
        return view('alumni.index');
    }

    public function updateTahunLulus(Request $request)
    {
        $tahun = $request->input('tahun');
        $namaKampus = Alumni::where('tahun_lulus', $tahun)->distinct()->pluck('nama_kampus')->toArray();
        return response()->json($namaKampus);
    }
}
