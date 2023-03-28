<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 

class LecturasContenido extends Model
{
    use HasFactory; 
    protected $table = 'contenido_lecturas';

    protected $fillable = [
        'contenido',
        'posicion',
        'tipo_contenido_id',
        'sesion_lectura_id',
    ];

    public function tipoContenido()
    {
        return $this->belongsTo(LecturasContenidoTipo::class,'fk_tipo');
    }

    public function sesionLectura()
    {
        return $this->belongsTo(LecturasSession::class);
    }
}
