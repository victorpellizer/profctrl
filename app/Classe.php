<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    protected $table = 'classe_docente';
    public $timestamps = false;

    protected $fillable = [
        'dataInicioClasse',
        'Docente_idDocente',
        'Classe_idClasse',
        'Usuario_idUsuario'
    ];
    public function docente()
    {
        return $this->belongsTo('App\Docente');
    }
}

