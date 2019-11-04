<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LicencaDocente extends Model
{
    protected $table = 'licenca_docente';
    public $timestamps = false;

    protected $fillable = [
        'dataInicioLicenca',
        'Docente_idDocente',
        //'Usuario_idUsuario',
        'Licenca_idLicenca'
    ];
    public function licenca()
    {
        return $this->belongsTo('App\Licenca');
    }
    public function docente()
    {
        return $this->belongsTo('App\Docente');
    }
}