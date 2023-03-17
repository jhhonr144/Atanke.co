<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estados extends Model
{
    use HasFactory; 
    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'r_users_estados');
    }
}
