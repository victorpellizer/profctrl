<?php

namespace App\Http\Controllers;

use App\Classe;
use App\Funcao;
use App\Licenca;
use App\Lotacao;
use App\Nivel;
use App\Titulo;
use App\Docente;
use App\Remuneracao;
use App\ClasseDocente;
use App\FuncaoDocente;
use App\LicencaDocente;
use App\LotacaoDocente;
use App\NivelDocente;
use App\TituloDocente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ProgressaoController extends Controller
{
    public function index() //PAGINAÇÃO
    {
        $docentes = Docente::select('idDocente', 'status','nomeDocente')->paginate(10);
        foreach($docentes as $docente){
            $idDocente = $docente->idDocente;
            if($docente->status == 1)
                $docente->status = "Ativo";
            else $docente->status = "Inativo";

            $var = ClasseDocente::where('Docente_idDocente', '=', $idDocente)
                ->orderBy('dataInicioClasse', 'desc')
                ->first();
            $cls = Classe::where('idClasse', '=', $var['Classe_idClasse'])
                ->first();
            if(is_null($cls))
                $docente->classe = "Não possui";
            else $docente->classe = $cls['classe'];
            $var = NivelDocente::where('Docente_idDocente', '=', $idDocente)
                ->orderBy('dataInicioNivel', 'desc')
                ->first();
            $nvl = Nivel::where('idNivel', '=', $var['Nivel_idNivel'])
                ->first();
            if(is_null($nvl))
                $docente->nivel = "Não possui";
            else $docente->nivel = $nvl['nivel'];
            //$var = FuncaoDocente::where('Docente_idDocente', '=', $idDocente)
            //    ->orderBy('dataInicioFuncao', 'desc')
            //    ->first();
            //$func = Funcao::where('idFuncao', '=', $var['Funcao_idFuncao'])
            //    ->first();
            //if(is_null($func)){
            //    $docente->funcao = "Não possui";
            //} else $docente->funcao = $func['funcao'];

            $var = LotacaoDocente::where('Docente_idDocente', '=', $idDocente)
                ->orderBy('dataInicioLotacao', 'desc')
                ->first();
            $lot = Lotacao::where('idInstituicao', '=', $var['Instituicao_idInstituicao'])
                ->first();
            if(is_null($lot))
                $docente->lotacao = "Não possui";
            else $docente->lotacao = $lot['nomeInstituicao'];

            $beneficioS = Remuneracao::where('tipoBeneficio', '=', 'S')
                ->where('Docente_idDocente', '=', $idDocente)
                ->orderBy('idBeneficio', 'desc')
                ->first();
            if(is_null($beneficioS))
                $docente->beneficioS = 0;
            else $docente->beneficioS = $beneficioS->valorBeneficio;

            $beneficioD = Remuneracao::where('tipoBeneficio', '=', 'D')
                ->where('Docente_idDocente', '=', $idDocente)
                ->orderBy('idBeneficio', 'desc')
                ->first();
            if(is_null($beneficioD))
                $docente->beneficioD = 0;
            else $docente->beneficioD = $beneficioD->valorBeneficio;

            $beneficioTS = Remuneracao::where('tipoBeneficio', '=', 'TS')
                ->where('Docente_idDocente', '=', $idDocente)
                ->orderBy('idBeneficio', 'desc')
                ->first();
            if(is_null($beneficioTS))
                $docente->beneficioTS = 0;
            else $docente->beneficioTS = $beneficioTS->valorBeneficio;

            $beneficioG = Remuneracao::where('tipoBeneficio', '=', 'G')
                ->where('Docente_idDocente', '=', $idDocente)
                ->orderBy('idBeneficio', 'desc')
                ->first();
            if(is_null($beneficioG))
                $docente->beneficioG = 0;
            else $docente->beneficioG = $beneficioG->valorBeneficio;
            $docente->beneficioTotal = $docente->beneficioG + $docente->beneficioTS + $docente->beneficioD + $docente->beneficioS;
        }
        return view('progressao.index')->with(compact('docentes'));
    }
    /*
    public function index() //DATATABLES
    {
        //$docentes = Docente::all();
        $docentes = Docente::select('idDocente', 'status','nomeDocente')->get();

        foreach($docentes as $docente){
            $idDocente = $docente->idDocente;
            if($docente->status == 1)
                $docente->status = "Ativo";
            else $docente->status = "Inativo";

            $var = ClasseDocente::where('Docente_idDocente', '=', $idDocente)
                ->orderBy('dataInicioClasse', 'desc')
                ->first();
            $cls = Classe::where('idClasse', '=', $var['Classe_idClasse'])
                ->first();
            if(is_null($cls))
                $docente->classe = "Não possui";
            else $docente->classe = $cls['classe'];

            $var = NivelDocente::where('Docente_idDocente', '=', $idDocente)
                ->orderBy('dataInicioNivel', 'desc')
                ->first();
            $nvl = Nivel::where('idNivel', '=', $var['Nivel_idNivel'])
                ->first();
            if(is_null($nvl))
                $docente->nivel = "Não possui";
            else $docente->nivel = $nvl['nivel'];
            $var = FuncaoDocente::where('Docente_idDocente', '=', $idDocente)
                ->orderBy('dataInicioFuncao', 'desc')
                ->first();
            $func = Funcao::where('idFuncao', '=', $var['Funcao_idFuncao'])
                ->first();
            if(is_null($func)){
                $docente->funcao = "Não possui";
            } else $docente->funcao = $func['funcao'];

            $var = LotacaoDocente::where('Docente_idDocente', '=', $idDocente)
                ->orderBy('dataInicioLotacao', 'desc')
                ->first();
            $lot = Lotacao::where('idInstituicao', '=', $var['Instituicao_idInstituicao'])
                ->first();
            if(is_null($lot))
                $docente->lotacao = "Não possui";
            else $docente->lotacao = $lot['nomeInstituicao'];

            $beneficioS = Remuneracao::where('tipoBeneficio', '=', 'S')
                ->where('Docente_idDocente', '=', $idDocente)
                ->orderBy('idBeneficio', 'desc')
                ->first();
            if(is_null($beneficioS))
                $docente->beneficioS = 0;
            else $docente->beneficioS = $beneficioS->valorBeneficio;

            $beneficioD = Remuneracao::where('tipoBeneficio', '=', 'D')
                ->where('Docente_idDocente', '=', $idDocente)
                ->orderBy('idBeneficio', 'desc')
                ->first();
            if(is_null($beneficioD))
                $docente->beneficioD = 0;
            else $docente->beneficioD = $beneficioD->valorBeneficio;

            $beneficioTS = Remuneracao::where('tipoBeneficio', '=', 'TS')
                ->where('Docente_idDocente', '=', $idDocente)
                ->orderBy('idBeneficio', 'desc')
                ->first();
            if(is_null($beneficioTS))
                $docente->beneficioTS = 0;
            else $docente->beneficioTS = $beneficioTS->valorBeneficio;

            $beneficioG = Remuneracao::where('tipoBeneficio', '=', 'G')
                ->where('Docente_idDocente', '=', $idDocente)
                ->orderBy('idBeneficio', 'desc')
                ->first();
            if(is_null($beneficioG))
                $docente->beneficioG = 0;
            else $docente->beneficioG = $beneficioG->valorBeneficio;
            $docente->beneficioTotal = $docente->beneficioG + $docente->beneficioTS + $docente->beneficioD + $docente->beneficioS;
        }
        return view('progressao.indexAntigo')->with(compact('docentes'));
    }*/
    public function create()
    {
        //
    }
    public function show(Docente $docente)
    {
        //
    }
    public function store(Request $request)
    {
        //
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, Docente $docente)
    {
        //
    }
    public function destroy(Docente $docente)
    {
        //
    }
    public function progressaoList()   {
     $docentes = Docente::all();
        foreach($docentes as $docente){
            $idDocente = $docente->idDocente;
            $var = ClasseDocente::where('Docente_idDocente', '=', $idDocente)
                ->orderBy('dataInicioClasse', 'desc')
                ->first();
            $cls = Classe::where('idClasse', '=', $var['Classe_idClasse'])
                ->first();
            if(is_null($cls)){
                $docente->classe = "Não possui";
            } else $docente->classe = $cls['classe'];

            $var = NivelDocente::where('Docente_idDocente', '=', $idDocente)
                ->orderBy('dataInicioNivel', 'desc')
                ->first();
            $nvl = Nivel::where('idNivel', '=', $var['Nivel_idNivel'])
                ->first();
            if(is_null($nvl)){
                $docente->nivel = "Não possui";
            } else $docente->nivel = $nvl['nivel'];

            $var = FuncaoDocente::where('Docente_idDocente', '=', $idDocente)
                ->orderBy('dataInicioFuncao', 'desc')
                ->first();
            $func = Funcao::where('idFuncao', '=', $var['Funcao_idFuncao'])
                ->first();
            if(is_null($func)){
                $docente->funcao = "Não possui";
            } else $docente->funcao = $func['funcao'];

            $var = LotacaoDocente::where('Docente_idDocente', '=', $idDocente)
                ->orderBy('dataInicioLotacao', 'desc')
                ->first();
                
            $lot = Lotacao::where('idInstituicao', '=', $var['Instituicao_idInstituicao'])
                ->first();
            if(is_null($lot)){
                $docente->lotacao = "Não possui";
            } else $docente->lotacao = $lot['nomeInstituicao'];

            $beneficioS = Remuneracao::where('tipoBeneficio', '=', 'S')
                ->where('Docente_idDocente', '=', $idDocente)
                ->orderBy('idBeneficio', 'desc')
                ->first();
            if(is_null($beneficioS)){
                $salario = 0;
            } else $salario = $beneficioS->valorBeneficio;

            $beneficioD = Remuneracao::where('tipoBeneficio', '=', 'D')
                ->where('Docente_idDocente', '=', $idDocente)
                ->orderBy('idBeneficio', 'desc')
                ->first();
            if(is_null($beneficioD)){
                $deslocamento = 0;
            } else $deslocamento = $beneficioD->valorBeneficio;

            $beneficioTS = Remuneracao::where('tipoBeneficio', '=', 'TS')
                ->where('Docente_idDocente', '=', $idDocente)
                ->orderBy('idBeneficio', 'desc')
                ->first();
            if(is_null($beneficioTS)){
                $temposervico = 0;
            } else $temposervico = $beneficioTS->valorBeneficio;

            $beneficioG = Remuneracao::where('tipoBeneficio', '=', 'G')
                ->where('Docente_idDocente', '=', $idDocente)
                ->orderBy('idBeneficio', 'desc')
                ->first();
            if(is_null($beneficioG)){
                $gratificacao = 0;
            } else $gratificacao = $beneficioG->valorBeneficio;
            $docente->beneficioTotal = $gratificacao + $temposervico + $deslocamento + $salario;
			if($docente->status == '1'){
                $docente->status = "Ativo";
            } else $docente->status = "Inativo";
        }
        return datatables()->of($docentes   )
            ->make(true);
    }
}