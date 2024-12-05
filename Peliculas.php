<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peliculas extends Model
{
    use HasFactory;
    protected $table = 'peliculas';
    protected $fillable = [
        'titulo',
        'titulo_original',
        'año_estreno',
        'genero',
        'duracion',
        'sinopsis',
        'clasificacion',
        'idioma',
        'poster'
    ];
}