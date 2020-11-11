<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regra extends Model
{
    protected $table = 'regra';
    protected $primaryKey = 'idRegra';
    public $timestamps = false;
    protected $fillable = [
        'salarioBase',
        'aumentoNivelB',
        'aumentoNivelC',
        'aumentoNivelD',
        'aumentoClasse',
        'aumentoTDS',
        'dataRegra',
        'Usuario_idUsuario',
	    'gratificacao1',
        'deslocamento',
        'gratificacao2',
        'gratificacao3',
        'gratificacao4',
        'gratificacao5',
        'descricao'
    ];
}
