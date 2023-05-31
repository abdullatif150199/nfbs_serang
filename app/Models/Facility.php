<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'priority'];

    public function subfacilities()
    {
        return $this->hasMany(SubFacility::class);
    }

    public function scopePriority($query)
    {
        return $query->oldest('priority');
    }
}
