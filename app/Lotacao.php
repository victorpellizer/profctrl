<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lotacao extends Model
{
    protected $table = 'instituicao';
    protected $primaryKey = 'idInstituicao';
    public $timestamps = false;
    protected $fillable = [
        'contatoInstituicao',
        'nomeInstituicao'
    ];
    public function docentes()
    {
        return $this->belongsToMany('App\Docente','lotacao_docente','Instituicao_idInstituicao', 'Docente_idDocente');
    }
}
