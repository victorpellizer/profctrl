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
       'nivel',
       'titulo',
       'classe',
       'licenca',
       'remuneracao',
       'lotacao'
   ];
   public function titulos()
   {
       return $this->hasMany('App\Titulo','Docente_idDocente', 'idDocente');
   }
   public function licencas()
   {
       return $this->hasMany('App\Licenca','Docente_idDocente', 'idDocente');
   }
    //$licencas = Docente::find(1)->licencas;
   // foreach($licencas as $licenca){}
   public function classe()
   {
    return  $this->hasMany('App\Classe','Docente_idDocente', 'idDocente');
   }
   public function nivel()
   {
       return $this->hasMany('App\Nivel','Docente_idDocente', 'idDocente');
   }
   public function funcao()
   {
       return $this->hasMany('App\Funcao','Docente_idDocente', 'idDocente');
   }
   public function lotacao()
   {
       return $this->hasMany('App\Lotacao','Docente_idDocente', 'idDocente');
   }

   public function remuneracao()
   {
       return $this->hasMany('App\Remuneracao','Docente_idDocente', 'idDocente');
   }
   protected $hidden = [
       //
   ];
}
