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
        'nomeArquivo',
        'nomeLicenca',
        'Docente_idDocente'
    ];
    public function docentes()
    {
        return $this->belongsToMany('App\Docente');
    }
}
