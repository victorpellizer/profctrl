<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lotacao extends Model
{
    protected $table = 'lotacao_docente';
    public $timestamps = false;

    protected $fillable = [
        'dataInicioLotacao',
        'Docente_idDocente',
        'Lotacao_idLotacao',
        'Instituicao_idInstituicao',
        'Usuario_idUsuario'
    ];
    public function docente()
    {
        return $this->belongsTo('App\Docente');
    }
}
