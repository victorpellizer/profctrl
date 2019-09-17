<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Titulo extends Model
{
    protected $table = 'titulo_docente';
    public $timestamps = false;

    protected $fillable = [
        'dataTitulo',
        'Docente_idDocente',
        'Titulo_idTitulo',
        'Usuario_idUsuario'
    ];
    public function docente()
    {
        return $this->belongsTo('App\Docente');
    }
}
