<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 

class LecturasSession  extends Model
{
    use HasFactory;
    protected $table = 'session_lecturas';

    protected $fillable = [
        'nombre',
        'posicion',
        'lectura_id',
    ];

    public function lectura()
    {
        return $this->belongsTo(Lectura::class);
    }

    public function contenidoLecturas()
    {
        return $this->hasMany(LecturasContenido::class);
    }
}
