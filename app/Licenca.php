<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Licenca extends Model
{
    protected $table = 'licenca_docente';
    public $timestamps = false;

    protected $fillable = [
        'dataInicioLicenca',
        'Docente_idDocente',
        'Licenca_idLicenca',
        'Usuario_idUsuario'
    ];
    public function docente()
    {
        return $this->belongsTo('App\Docente');
    }
}
