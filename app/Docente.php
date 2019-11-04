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
   // --------- REMUNERAÇÃO TOTAL
   public function valorTotalRemuneracao()
   {
       $idDocente = $this->idDocente;
   
       $beneficioS = Remuneracao::where('tipoBeneficio', '=', 'S')
           ->where('Docente_idDocente', '=', $idDocente)
           ->orderBy('idBeneficio', 'desc')
           ->first();

       $beneficioD = Remuneracao::where('tipoBeneficio', '=', 'D')
           ->where('Docente_idDocente', '=', $idDocente)
           ->orderBy('idBeneficio', 'desc')
           ->first();
   
       $beneficioTS = Remuneracao::where('tipoBeneficio', '=', 'TS')
           ->where('Docente_idDocente', '=', $idDocente)
           ->orderBy('idBeneficio', 'desc')
           ->first();
   
       $beneficioG = Remuneracao::where('tipoBeneficio', '=', 'G')
           ->where('Docente_idDocente', '=', $idDocente)
           ->orderBy('idBeneficio', 'desc')
           ->first();

        $totalRemuneracao = 0;
       if(!is_null($beneficioS)){
            $totalRemuneracao = $beneficioS->valorBeneficio;
       }
       if(!is_null($beneficioD)){
            $totalRemuneracao += $beneficioD->valorBeneficio;
       }
       if(!is_null($beneficioTS)) {
         $totalRemuneracao += $beneficioTS->valorBeneficio;
       }
       if(!is_null($beneficioG)) {
            $totalRemuneracao += $beneficioG->valorBeneficio;
       }
       return $totalRemuneracao;
   }

   // --------- SALÁRIO
   public function valorBeneficioS()
   {
        $idDocente = $this->idDocente;
        $beneficioS = Remuneracao::where('tipoBeneficio', '=', 'S')
            ->where('Docente_idDocente', '=', $idDocente)
            ->orderBy('idBeneficio', 'desc')
            ->first();
        if(isnull($beneficioS)){
            $valor = 0;
        } else $valor = $beneficioS->valorBeneficio;
        return $valor;
   }
   // --------- DESLOCAMENTO
   public function valorBeneficioD()
   {
        $idDocente = $this->idDocente;
        $beneficioD = Remuneracao::where('tipoBeneficio', '=', 'D')
            ->where('Docente_idDocente', '=', $idDocente)
            ->orderBy('idBeneficio', 'desc')
            ->first();
        if(isnull($beneficioD)){
            $valor = 0;
        } else $valor = $beneficioD->valorBeneficio;
        return $valor;
   }
   // --------- TEMPO DE SERVIÇO
   public function valorBeneficioTS()
   {
        $idDocente = $this->idDocente;
        $beneficioTS = Remuneracao::where('tipoBeneficio', '=', 'TS')
            ->where('Docente_idDocente', '=', $idDocente)
            ->orderBy('idBeneficio', 'desc')
            ->first();
        if(isnull($beneficioTS)){
            $valor = 0;
        } else $valor = $beneficioTS->valorBeneficio;
        return $valor;
   }
   // --------- GRATIFICAÇÃO
   public function valorBeneficioG()
   {
        $idDocente = $this->idDocente;
        $beneficioG = Remuneracao::where('tipoBeneficio', '=', 'G')
            ->where('Docente_idDocente', '=', $idDocente)
            ->orderBy('idBeneficio', 'desc')
            ->first();
        if(isnull($beneficioG)){
            $valor = 0;
        } else $valor = $beneficioG->valorBeneficio;
        return $valor;
   }
   public function classeAtual()
   {
        $idDocente = $this->idDocente;
        $cls = Classe::where('Docente_idDocente', '=', $idDocente)
            ->orderBy('idClasse', 'desc')
            ->first();
        $valor = $cls->classe;
        return $valor;
   }
   public function nivelAtual()
   {
        $idDocente = $this->idDocente;
        $nvl = Nivel::where('Docente_idDocente', '=', $idDocente)
            ->orderBy('idNivel', 'desc')
            ->first();
        $valor = $nvl->nivel;
        return $valor;
   }
   public function funcaoAtual()
   {
        $idDocente = $this->idDocente;
        $func = Funcao::where('Docente_idDocente', '=', $idDocente)
            ->orderBy('idFuncao', 'desc')
            ->first();
        $valor = $func->funcao;
        return $valor;
   }
   public function lotacaoAtual()
   {
        $idDocente = $this->idDocente;
        $lot = Lotacao::where('Docente_idDocente', '=', $idDocente)
            ->orderBy('idInstituicao', 'desc')
            ->first();
        $valor = $lot->nomeInstituicao;
        return $valor;
   }
   public function licencasTotal()
   {
        $idDocente = $this->idDocente;
        $licencas = Licenca::where('Docente_idDocente', '=', $idDocente)
            ->get();
        return $licencas;
   }
   public function titulosTotal()
   {
        $idDocente = $this->idDocente;
        $titulo = Licenca::where('Docente_idDocente', '=', $idDocente)
            ->get();
        return $titulos;
   }
   public function classes()
   {
    return $this->belongsToMany('App\Classe','classe_docente');
   }
   public function titulos()
   {
       return $this->belongsToMany('App\Titulo','titulo_docente');
   }
   public function licencas()
   {
       return $this->belongsToMany('App\Licenca','licenca_docente');
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
