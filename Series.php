<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    protected $table = 'series';
    protected $fillable = [
        'titulo',
        'titulo_original',
        'año_inicio',
        'año_fin',
        'estado',
        'genero',
        'sinopsis',
        'clasificacion',
        'idioma',
        'pais',
        'creador',
        'poster',
        'temporadas',
        'capitulos'
    ];
}
