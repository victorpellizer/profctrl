<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Licenca extends Model
{
    protected $table = 'licenca';
    protected $primaryKey = 'idLicenca';
    public $timestamps = false;
    protected $fillable = [
        'tipoLicenca',
        'dataLicenca',
        'dataInsercao',
        'nomeArquivo',
        'nomeLicenca',
        'Docente_idDocente',
        'Usuario_idUsuario'
    ];
    public function docentes()
    {
        return $this->belongsToMany('App\Docente');
    }
}
