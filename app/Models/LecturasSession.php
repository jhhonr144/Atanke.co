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
        'fk_lectura',
    ];

    public function lectura()
    {
        return $this->belongsTo(Lecturas::class,'fk_lectura');
    }

    public function contenidoLecturas()
    {
        return $this->hasMany(LecturasContenido::class, 'fk_sesion');
    }
    
}
