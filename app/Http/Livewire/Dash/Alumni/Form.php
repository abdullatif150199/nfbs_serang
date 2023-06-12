<?php

namespace App\Http\Livewire\Dash\Alumni;

use Livewire\Component;
use App\Models\Alumni;
use Illuminate\Support\Facades\Storage;

class Form extends Component
{

    public $alumniId;
    public $alumni;
    public $nama;
    public $jurusan;
    public $nama_kampus;
    public $jenis_kampus;
    public $letak_kampus;
    public $tahun_lulus;
    public $image;
    public $published_at;
    public $listJenisKampus;
    public $listLetakKampus;
    public $listTahunLulus;
  

    public function mount($id)
    {
        if (!is_null($id)) {
            $this->alumniId = $id;
            $this->alumni = Alumni::find($id);
            $this->nama = $this->alumni->nama;
            $this->jurusan = $this->alumni->jurusan;
            $this->nama_kampus = $this->alumni->nama_kampus;
            $this->jenis_kampus = $this->alumni->jenis_kampus;
            $this->letak_kampus = $this->alumni->letak_kampus;
            $this->tahun_lulus = $this->alumni->tahun_lulus;
            $this->image = $this->alumni->image;
        }

        $this->listJenisKampus = [
            'Swasta' => 'Swasta',
            'Negeri' => 'Negeri'];
        $this->listLetakKampus = [
            'Dalam Negeri' => 'Dalam Negeri',
            'Luar Negeri' => 'Luar Negeri'
        ];
        $this->listTahunLulus = array_combine(range(2000, 2050), range(2000, 2050));

    }

    public function render()
    {
        return view('livewire.dash.alumni.form');
    }  

    public function save()
    {
    
        $validatedData = $this->validate([
            'nama' => 'required|max:225',
            'jurusan' => 'required|max:225',
            'nama_kampus' => 'required|max:225',
            'letak_kampus' => 'required|max:225',
            'jenis_kampus' => 'required|max:225',
            'tahun_lulus' => 'required|max:225'
        ]);

        // dd($validatedData);
    
        if (!is_null($this->alumniId)) {
            $alumni = Alumni::where('id', $this->alumniId)->firstOrFail();
            $alumni->nama = $validatedData['nama'];
            $alumni->jurusan = $validatedData['jurusan'];
            $alumni->nama_kampus = $validatedData['nama_kampus'];
            $alumni->letak_kampus = $validatedData['letak_kampus'];
            $alumni->jenis_kampus = $validatedData['jenis_kampus'];
            $alumni->tahun_lulus = $validatedData['tahun_lulus'];
            $alumni->save();
        } else {
            Alumni::create($validatedData);
        }
        return redirect()->route('dash.views', 'alumni');
    }
}
