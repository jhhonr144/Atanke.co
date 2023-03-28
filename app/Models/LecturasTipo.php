<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class LecturasTipo extends Model
{
    use HasFactory;
    protected $table = 'tipo_lecturas';

    protected $fillable = [
        'nombre',
    ];

    
    public function lecturas()
    {
        return $this->hasMany(Lecturas::class);
    }
}
