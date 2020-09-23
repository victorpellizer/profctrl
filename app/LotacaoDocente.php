<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LotacaoDocente extends Model
{
    protected $table = 'lotacao_docente';
    public $timestamps = false;

    protected $fillable = [
        'dataInicioLotacao',
        'Docente_idDocente',
        'Usuario_idUsuario',
        'Instituicao_idInstituicao'
    ];
    public function lotacao()
    {
        return $this->belongsTo('App\Lotacao');
    }
    public function docente()
    {
        return $this->belongsTo('App\Docente');
    }
}