<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'evento';
    public $timestamps = false;
    protected $primaryKey = 'idEvento';

    protected $fillable = [
        'docente_idDocente',
        'tipo_evento_idTipoEvento',
        'valorEvento',
        'regraVigente',
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