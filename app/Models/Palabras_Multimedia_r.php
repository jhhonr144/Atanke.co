<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Palabras_Multimedia_r extends Model
{
    use HasFactory;
    protected $table = 'palabras_multimedia_r'; 

    public function palabra()
    {
        return $this->belongsTo(Palabras::class, 'fk_palabra');
    }

    public function multimedia()
    {
        return $this->belongsTo(Multimedias::class, 'fk_multimedia');
    }
}
