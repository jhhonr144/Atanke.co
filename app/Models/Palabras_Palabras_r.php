<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Palabras_Palabras_r extends Model
{
    use HasFactory;
    protected $table = "palabras_palabras_r";
    protected $primaryKey='id';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable=[
        'palabra_id_1'
       ,'palabra_id_2'
       ,'relacion'
       ,'dateCreate'
     ];
}
