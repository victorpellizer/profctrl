<?php

namespace App\Http\Controllers;

use App\Docente;
use Illuminate\Http\Request;
use DB;

class DocenteController extends Controller
{
    public function index()
    {
        $docente = new Docente();
        $docentes = $docente->all();
        return view('docentes.index')->with(compact('docentes'));
    }
    public function create()
    {
        return view('docentes.novo');
    }
    public function store(Request $request)
    {
        $docente = new Docente();
        $docente->fill($request->all());
        $docente->status = 1;
        $docente->pontosDeDesempenho = 0;

        $classe = new ClasseDocente();
        $classe->fill($request->all());
        //$classe->dataInicioClasse = ? <- aparentemente deverá estar incluído no request
        $classe->Docente_idDocente = $docente->idDocente;

        $funcao = new FuncaoDocente();
        $funcao->fill($request->all());
        //$funcao->dataInicioFuncao = ? <- aparentemente deverá estar incluído no request
        $funcao->Docente_idDocente = $docente->idDocente;

        $lotacao = new LotacaoDocente();
        $lotacao->fill($request->all());
        //$lotacao->dataInicioLotacao = ? <- aparentemente deverá estar incluído no request
        $lotacao->Docente_idDocente = $docente->idDocente;

        $nivel = new NivelDocente();
        $nivel->fill($request->all());
        //$nivel->dataInicioNivel = ? <- aparentemente deverá estar incluído no request
        $nivel->Docente_idDocente = $docente->idDocente;

        $base = 725.5;
        $base2 = 1451;
        $classeA = 1.03;
        $classeB = 1.3;
        $classeC = 1.3*1.18;
        $classeD = 1.3*1.18*1.3;
        $remuneracaoS = new Remuneracao();
        $remuneracaoS->Docente_idDocente = $docente->idDocente;
        $remuneracaoS->tipoBeneficio = 'S';
        //$remuneracao->dataInicioBeneficio = ?
        if($docente->cargaHoraria == 20){
            if($docente->nivel == 'A') $remuneracaoS->valorBeneficio = $base * $classeA ^ ($docente->classe - 1);
            if($docente->nivel == 'B') $remuneracaoS->valorBeneficio = $base * $classeA ^ ($docente->classe - 1) * $classeB;
            if($docente->nivel == 'C') $remuneracaoS->valorBeneficio = $base * $classeA ^ ($docente->classe - 1) * $classeC;
            if($docente->nivel == 'D') $remuneracaoS->valorBeneficio = $base * $classeA ^ ($docente->classe - 1) * $classeD;
        }
        else if($docente->cargaHoraria == 40){
            if($docente->nivel == 'A') $remuneracaoS->valorBeneficio = $base2 * $classeA ^ ($docente->classe - 1);
            if($docente->nivel == 'B') $remuneracaoS->valorBeneficio = $base2 * $classeA ^ ($docente->classe - 1) * $classeB;
            if($docente->nivel == 'C') $remuneracaoS->valorBeneficio = $base2 * $classeA ^ ($docente->classe - 1) * $classeC;
            if($docente->nivel == 'D') $remuneracaoS->valorBeneficio = $base2 * $classeA ^ ($docente->classe - 1) * $classeD;
        }
        else $remuneracaoS->valorBeneficio = 0;

        $remuneracaoTS = new Remuneracao();
        $remuneracaoTS->Docente_idDocente = $docente->idDocente;
        $remuneracaoTS->tipoBeneficio = 'TS';
        $remuneracaoTS->valorBeneficio = $docente->tempoDeServico * $remuneracaoS->valorBeneficio / 100;

        $remuneracaoG = new Remuneracao();
        $remuneracaoG->Docente_idDocente = $docente->idDocente;
        $remuneracaoG->tipoBeneficio = 'G';
        if(!is_null($request->valorGratificacao)){
            $remuneracaoG->valorBeneficio = $request->valorGratificacao;
        } else $remuneracaoG->valorBeneficio = 0;

        $remuneracaoD = new Remuneracao();
        $remuneracaoD->Docente_idDocente = $docente->idDocente;
        $remuneracaoD->tipoBeneficio = 'D';
        if(!is_null($request->valorDeslocamento)){
            $remuneracaoD->valorBeneficio = $request->valorDeslocamento;
        } else $remuneracaoD->valorBeneficio = 0;

        $cidade = DB::table('cidade')->where('nomeCidade','like',$request->cidade)->first();
        $docente->cidadeIdCidade = $cidade->idCidade;

        if($docente->save() && $classe->save() && $funcao->save() && $lotacao->save() && $nivel->save() && $remuneracaoS->save() && $remuneracaoTS->save() && $remuneracaoG->save() && $remuneracaoD->save()){
            return redirect()->back()->with('success', ['Cadastrado com sucesso!']);
        }else{
            return redirect()->back()->with('error', ['Não foi possível cadastrar!']);
        }
    }
    public function show($id)
    {
        $docente = Docente::find($id);
        return view('docentes.show')->with(compact('docente'));
    }
    public function edit($id)
    {
        $docente = Docente::find($id);
        return view('docentes.editar')->with(compact('docente'));
    }
    public function update(Request $request, $id)
    {
        $docente = Docente::find($id);
        $docente->fill($request->all());

        if($docente->status == 0){
            $remuneracaoS = new Remuneracao();
            $remuneracaoS->Docente_idDocente = $docente->idDocente;
            $remuneracaoS->tipoBeneficio = 'S';
            $remuneracaoS->valorBeneficio = 0;
            //$remuneracaoS->dataInicioBeneficio = ?
            $remuneracaoD = new Remuneracao();
            $remuneracaoD->Docente_idDocente = $docente->idDocente;
            $remuneracaoD->tipoBeneficio = 'D';
            $remuneracaoD->valorBeneficio = 0;
            //$remuneracaoD->dataInicioBeneficio = ?
            $remuneracaoTS = new Remuneracao();
            $remuneracaoTS->Docente_idDocente = $docente->idDocente;
            $remuneracaoTS->tipoBeneficio = 'TS';
            $remuneracaoTS->valorBeneficio = 0;
            //$remuneracaoTS->dataInicioBeneficio = ?
            $remuneracaoG = new Remuneracao();
            $remuneracaoG->Docente_idDocente = $docente->idDocente;
            $remuneracaoG->tipoBeneficio = 'G';
            $remuneracaoG->valorBeneficio = 0;
            //$remuneracaoG->dataInicioBeneficio = ?
            $lotacao = new Lotacao();
            $lotacao->contatoInstituicao = 0;
            $lotacao->nomeInstituicao = 0;
            $lotacao->save();
            $remuneracaoS->save();
            $remuneracaoTS->save();
            $remuneracaoG->save();
            $remuneracaoD->save();
        }

        $cidade = DB::table('cidade')->where('nomeCidade','like',$request->cidade)->first();
        $docente->cidadeIdCidade = $cidade->idCidade;

        if($docente->update()){
            return redirect()->back()->with('success', ['Atualizado com sucesso!']);
        }else{
            return redirect()->back()->with('error', ['Não foi possível atualizar!']);
        }
    }
    public function destroy(Docente $docente)
    {
        //
    }
}
