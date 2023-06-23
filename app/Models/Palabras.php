<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Palabras extends Model
{
    use HasFactory;
    protected $fillable = ['palabra', 'pronunciar', 'fk_user', 'fk_idioma', 'estado'];

    public function user()
    {
        return $this->belongsTo(User::class, 'fk_user');
    }

    public function idioma()
    {
        return $this->belongsTo(Idiomas::class, 'fk_idioma');
    }
    public function multimedia()
    {
        return $this->belongsToMany(
            Multimedias::class,
            'palabras_multimedia_r',
            'fk_palabra',
            'fk_multimedia'
        );
    }
  
    public function multimediaTipo($tipo)
    {
        return $this->belongsToMany(
            Multimedias::class,
            'palabras_multimedia_r',
            'fk_palabra',
            'fk_multimedia'
        )->where('fk_tm', $tipo)->optional();
    }
}
