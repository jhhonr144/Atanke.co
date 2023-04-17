<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolesPermisoR extends Model
{
    use HasFactory;
    protected $table = "roles_permisos_r";

    protected $fillable = ['id', 'fk_permiso', 'fk_rol'];

    public function permisos()
    {        
        return $this->belongsTo(Permisos::class, 'fk_rol');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'fk_user');
    }   
}
