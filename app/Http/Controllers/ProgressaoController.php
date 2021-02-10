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
use App\LotacaoDocente;
use App\NivelDocente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;


use App\Exports\ProgressaoExportCSV;
use App\Exports\ProgressaoExportXLSX;
use Maatwebsite\Excel\Facades\Excel;

class ProgressaoController extends Controller
{
    public function busca()
    {
        $texto_busca = $_GET['query'];
        $docentes = Docente::where('status', '=', '1')
            ->where('nomeDocente','LIKE','%'.$texto_busca.'%')
            ->orWhere('matricula','LIKE','%'.$texto_busca.'%')
            ->orderBy('nomeDocente')
            ->paginate(10);
        foreach($docentes as $docente){
            $idDocente = $docente->idDocente;
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
                $auxS = 0;
            else $auxS = $beneficioS->valorBeneficio;

            $beneficioD = Remuneracao::where('tipoBeneficio', '=', 'D')
                ->where('Docente_idDocente', '=', $idDocente)
                ->orderBy('idBeneficio', 'desc')
                ->first();
            if(is_null($beneficioD))
                $auxD = 0;
            else $auxD = $beneficioD->valorBeneficio;

            $beneficioTS = Remuneracao::where('tipoBeneficio', '=', 'TS')
                ->where('Docente_idDocente', '=', $idDocente)
                ->orderBy('idBeneficio', 'desc')
                ->first();
            if(is_null($beneficioTS))
                $auxTS = 0;
            else $auxTS = $beneficioTS->valorBeneficio;

            $beneficioG = Remuneracao::where('tipoBeneficio', '=', 'G')
                ->where('Docente_idDocente', '=', $idDocente)
                ->orderBy('idBeneficio', 'desc')
                ->first();
            if(is_null($beneficioG))
                $auxG = 0;
            else $auxG = $beneficioG->valorBeneficio;
            $docente->beneficioTotal = number_format($auxG + $auxTS + $auxD + $auxS, 2, ',', '.');
        }    
        return view('progressao.busca')
            ->with(compact('docentes'));
    }
    public function index() //PAGINAÇÃO
    {
        $docentes = Docente::select('idDocente', 'matricula','nomeDocente')
            ->where('status', '=', '1')
            ->orderBy('nomeDocente')
            ->paginate(10);
        foreach($docentes as $docente){
            $idDocente = $docente->idDocente;
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
                $auxS = 0;
            else $auxS = $beneficioS->valorBeneficio;

            $beneficioD = Remuneracao::where('tipoBeneficio', '=', 'D')
                ->where('Docente_idDocente', '=', $idDocente)
                ->orderBy('idBeneficio', 'desc')
                ->first();
            if(is_null($beneficioD))
                $auxD = 0;
            else $auxD = $beneficioD->valorBeneficio;

            $beneficioTS = Remuneracao::where('tipoBeneficio', '=', 'TS')
                ->where('Docente_idDocente', '=', $idDocente)
                ->orderBy('idBeneficio', 'desc')
                ->first();
            if(is_null($beneficioTS))
                $auxTS = 0;
            else $auxTS = $beneficioTS->valorBeneficio;

            $beneficioG = Remuneracao::where('tipoBeneficio', '=', 'G')
                ->where('Docente_idDocente', '=', $idDocente)
                ->orderBy('idBeneficio', 'desc')
                ->first();
            if(is_null($beneficioG))
                $auxG = 0;
            else $auxG = $beneficioG->valorBeneficio;
            $docente->beneficioTotal = number_format($auxG + $auxTS + $auxD + $auxS, 2, ',', '.');
        }
        return view('progressao.index')->with(compact('docentes'));
    }
    public function exportCSV() 
    {
        return Excel::download(new ProgressaoExportCSV, 'progressao.csv');
    }
    public function exportXLSX() 
    {
        return Excel::download(new ProgressaoExportXLSX, 'progressao.xlsx');
    }
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
}