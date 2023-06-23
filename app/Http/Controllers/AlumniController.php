<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumni;

class AlumniController extends Controller
{
    public function index ()
    {
        return view('alumni.index');
    }

    public function updateNamaKampus(Request $request)
    {
        // dd($request);
        $tahunLulus = $request->input('selectedValue');
        $nama_kampus_arr = [' ' => 'Semua'];
        $namaKampus = Alumni::where('tahun_lulus', $tahunLulus)->distinct()->pluck('nama_kampus');
        
        return response()->json($namaKampus);
    }
}
