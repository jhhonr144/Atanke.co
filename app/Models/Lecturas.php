<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Lecturas extends Model
{
    use HasFactory;
    protected $table = 'lecturas';

    protected $fillable = [
        'nombre',
        'descripcion',
        'fk_portada',
        'fk_tipo',
        'user_id',
    ];

    public function tipo()
    {
        return $this->belongsTo(LecturasTipo::class, 'fk_tipo');
    }

    public function portada()
    {
        return $this->belongsTo(Multimedias::class, 'fk_portada');
    }

    public function sesiones()
    {
        return $this->hasMany(LecturasSession::class, 'fk_lectura');
    }
     public function user()
    {
        return $this->belongsTo(User::class);
    }
}
