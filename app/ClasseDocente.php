<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClasseDocente extends Model
{
    protected $table = 'classe_docente';
    public $timestamps = false;

    protected $fillable = [
        'dataInicioClasse',
        'Docente_idDocente',
        'Usuario_idUsuario',
        'Classe_idClasse'
    ];
    public function classe()
    {
        return $this->belongsTo('App\Classe');
    }
    public function docente()
    {
        return $this->belongsTo('App\Docente');
    }
}