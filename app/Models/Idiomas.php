<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idiomas extends Model
{
    use HasFactory;
    protected $table = "idiomas";
    protected $primaryKey='id';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable=[
        'nombre'
       ,'created_at'
     ];
}
