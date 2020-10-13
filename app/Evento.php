<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'evento';
    public $timestamps = false;
    protected $primaryKey = 'idEvento';

    protected $fillable = [
        'Docente_idDocente',
        'TipoEvento_idTipoEvento',
        'valorAntigo',
        'valorNovo',
        'Regra_idRegra',
        'dataEvento',
        'Usuario_idUsuario'
    ];
    public function evento()
    {
        return $this->belongsTo('App\Evento');
    }
    public function docente()
    {
        return $this->belongsTo('App\Docente');
    }
}