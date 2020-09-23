<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FuncaoDocente extends Model
{
    protected $table = 'funcao_docente';
    public $timestamps = false;

    protected $fillable = [
        'dataInicioFuncao',
        'Docente_idDocente',
        'Usuario_idUsuario',
        'Funcao_idFuncao'
    ];
    public function funcao()
    {
        return $this->belongsTo('App\Funcao');
    }
    public function docente()
    {
        return $this->belongsTo('App\Docente');
    }
}