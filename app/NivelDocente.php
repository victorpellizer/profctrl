<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NivelDocente extends Model
{
    protected $table = 'nivel_docente';
    public $timestamps = false;

    protected $fillable = [
        'dataInicioNivel',
        'Docente_idDocente',
        'Usuario_idUsuario',
        'Nivel_idNivel'
    ];
    public function nivel()
    {
        return $this->belongsTo('App\Nivel');
    }
    public function docente()
    {
        return $this->belongsTo('App\Docente');
    }
}