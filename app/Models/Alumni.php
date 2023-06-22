<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    public function setNamaKampusAttribute($value)
    {
        $this->attributes['nama_kampus'] = strtoupper($value);
    }

    public function setJurusanAttribute($value)
    {
        $this->attributes['jurusan'] = ucwords($value);
    }
}
