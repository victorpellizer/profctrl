<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
   protected $table = 'docente';
   protected $primaryKey = 'idDocente';
   public $timestamps = false;
   protected $fillable = [
       'matricula',
       'nomeDocente',
       'cargo',
       'status',
       'pontosDeDesempenho',
       'cargaHoraria',
       'tempoDeServico',
       'cidadeIdCidade',
   ];
   public function classes()
   {
    return $this->belongsToMany('App\Classe','classe_docente');
   }
   public function titulos()
   {
       return $this->hasMany('App\Titulo','Docente_idDocente');
   }
   public function licencas()
   {
       return $this->hasMany('App\Licenca','Docente_idDocente');
   }
   public function niveis()
   {
       return $this->belongsToMany('App\Nivel','nivel_docente');
   }
   public function funcoes()
   {
       return $this->belongsToMany('App\Funcao','funcao_docente');
   }
   public function lotacoes()
   {
       return $this->belongsToMany('App\Lotacao','lotacao_docente','Instituicao_idInstituicao');
   }
   public function remuneracoes()
   {
       return $this->hasMany('App\Remuneracao','Docente_idDocente');
   }
   protected $hidden = [
       //
   ];
}
