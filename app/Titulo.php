<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Titulo extends Model
{
    protected $table = 'titulo';
    protected $primaryKey = 'idTitulo';
    public $timestamps = false;
    protected $fillable = [
        'nomeTitulo',
        'tipoTitulo',
        'pontosDeDesempenhoT',
        'dataTitulo',
        'dataInsercao',
        'nomeArquivo',
        //tamanhoArquivo,
        'Docente_idDocente',
        'Usuario_idUsuario'
    ];
    public function docentes()
    {
        return $this->belongsTo('App\Docente');
    }
}
