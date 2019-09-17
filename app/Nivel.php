<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    protected $table = 'nivel_docente';
    public $timestamps = false;

    protected $fillable = [
        'dataInicioNivel',
        'Docente_idDocente',
        'Nivel_idNivel',
        'Usuario_idUsuario'
    ];
    public function docente()
    {
        return $this->belongsTo('App\Docente');
    }
}
