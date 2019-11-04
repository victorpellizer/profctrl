<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TituloDocente extends Model
{
    protected $table = 'titulo_docente';
    public $timestamps = false;

    protected $fillable = [
        'dataTitulo',
        'Docente_idDocente',
        //'Usuario_idUsuario',
        'Titulo_idTitulo'
    ];
    public function titulo()
    {
        return $this->belongsTo('App\Titulo');
    }
    public function docente()
    {
        return $this->belongsTo('App\Docente');
    }
}