<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiposMultimedia extends Model
{
    use HasFactory;
    protected $fillable = ['id','nombre', 'r_tm_estados'];

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'r_tm_estados');
    }
}
