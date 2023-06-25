<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Palabras_Palabras_r extends Model
{
  use HasFactory;
  protected $table = "palabras_palabras_r"; 
  public $incrementing = false;
  public $timestamps = false;
  protected $fillable = [
    'palabra_id_1',
    'palabra_id_2',
    'relacion',
    'fk_user', 'dateCreate', 'estado'
  ];

  public function palabra1()
  {
    return $this->belongsTo(Palabras::class, 'palabra_id_1');
  }

  public function palabra2()
  {
    return $this->belongsTo(Palabras::class, 'palabra_id_2');
  }
  public function user()
  {
    return $this->belongsTo(User::class, 'fk_user');
  }
  public function palabras()
  {
    return $this->belongsTo(Palabras::class, 'palabra_id_1')->orWhere('palabra_id_2');
  }
  public function buscarPalabra($texto, $idioma)
  {
    if ($idioma == 0)
      return $this->where(function ($query) use ($texto) {
        $query->whereHas('palabra1', function ($subquery) use ($texto) {
          $subquery->where('palabra', 'LIKE', '%' . $texto . '%');
        });
      })
        ->orWhere(
          function ($query) use ($texto) {
            $query->whereHas('palabra2', function ($subquery) use ($texto) {
              $subquery->where('palabra', 'LIKE', '%' . $texto . '%');
            });
          }
        )->get();
    else
      return $this->where(function ($query) use ($texto, $idioma) {
        $query->whereHas('palabra1', function ($subquery) use ($texto, $idioma) {
          $subquery->where('palabra', 'LIKE', '%' . $texto . '%')
            ->where('fk_idioma', $idioma);
        });
      })
        ->orWhere(
          function ($query) use ($texto, $idioma) {
            $query->whereHas('palabra2', function ($subquery) use ($texto, $idioma) {
              $subquery->where('palabra', 'LIKE', '%' . $texto . '%')
                ->where('fk_idioma', $idioma);
            });
          }
        )->get();
  }
}
