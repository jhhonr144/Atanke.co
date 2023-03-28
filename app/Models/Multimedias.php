<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multimedias extends Model
{
    use HasFactory; 
    protected $fillable = [
        'descripcion',
        'multimedia',
        'fk_user',
        'fk_tm',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'fk_user');
    }

    public function tipoMultimedia()
    {
        return $this->belongsTo(TipoMultimedia::class, 'fk_tm');
    }
}
