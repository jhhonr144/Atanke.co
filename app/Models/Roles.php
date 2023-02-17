<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;
    protected $table = "roles";

    protected $fillable = ['id', 'nombre', 'descripcion'];

    public function permisos()
    {
        return $this->belongsToMany(
            Permisos::class,
            'roles_permisos_r',
            'fk_rol',
            'fk_permiso'
        );
    }
}
