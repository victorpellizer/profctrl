<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Remuneracao extends Model
{
    protected $table = 'beneficio';
    protected $primaryKey = 'idBeneficio';
    public $timestamps = false;
    protected $fillable = [
        'dataInicioBeneficio',
        'tipoBeneficio',
        'valorBeneficio',
        //'Usuario_idUsuario',
        'Docente_idDocente'
    ];
    public function docentes()
    {
        return $this->belongsTo('App\Docente');
    }
}