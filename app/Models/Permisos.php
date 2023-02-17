<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permisos extends Model
{
    use HasFactory; 
    protected $table = "permisos";

    protected $fillable = ['id', 'nombre', 'descripcion'];

    public function roles()
    {
        return $this->belongsToMany(
            Roles::class,
            'roles_permisos_r',
            'fk_permiso',
            'fk_rol'
        );
    }
}
