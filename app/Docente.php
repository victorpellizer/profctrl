<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
   protected $table = 'docente';
   protected $primaryKey = 'idDocente';
   public $timestamps = false;
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
       'matricula',
       'nomeDocente',
       'cargo',
       'status',
       'pontosDeDesempenho',
       'cargaHoraria',
       'tempoDeServico',
       'cidadeIdCidade',
       'nivel',
       'titulo',
       'classe',
       'licenca',
       'remuneracao',
       'lotacao'
   ];
   /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
   protected $hidden = [
       //
   ];
}
