<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Remuneracao extends Model
{
    protected $table = 'funcao_docente';
    public $timestamps = false;

    protected $fillable = [
        'dataInicioFuncao',
        'Docente_idDocente',
        'Funcao_idFuncao',
        'Usuario_idUsuario'
    ];
    public function docente()
    {
        return $this->belongsTo('App\Docente');
    }
}
