<?php

namespace App\Http\Controllers;

use App\Remuneracao;
use Illuminate\Http\Request;

class RemuneracaoController extends Controller
{
    public function index()
    {
        //
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {

    }
    public function show(Remuneracao $remuneracao)
    {
        //
    }
    public function edit($id)
    {
        $docente = Docente::find($id);
        return view('remuneracao.editar')->with(compact('docente'));
    }
    public function update(Request $request, $id)
    {
        $docente = Docente::find($id);
        if($docente->pontosDeDesempenho >= 100){
            $docente->pontosDeDesempenho -= 100;
            if($docente->classe < 15){
                $cls = new ClasseDocente();
                $cls->Docente_idDocente = $docente->idDocente;
                $cls->classe = $docente->classe + 1;
                $cls->save();
            }
        }
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
        $remuneracaoS->save();

        $remuneracaoTS = new Remuneracao();
        $remuneracaoTS->Docente_idDocente = $docente->idDocente;
        $remuneracaoTS->tipoBeneficio = 'TS';
        $remuneracaoTS->valorBeneficio = $docente->tempoDeServico * $remuneracaoS->valorBeneficio / 100;
        $remuneracaoTS->save();

        $remuneracaoG = new Remuneracao();
        $remuneracaoG->Docente_idDocente = $docente->idDocente;
        $remuneracaoG->tipoBeneficio = 'G';
        if(!is_null($request->valorGratificacao)){
            $remuneracaoG->valorBeneficio = $request->valorGratificacao;
        } else $remuneracaoG->valorBeneficio = 0;
        $remuneracaoG->save();

        $remuneracaoD = new Remuneracao();
        $remuneracaoD->Docente_idDocente = $docente->idDocente;
        $remuneracaoD->tipoBeneficio = 'D';
        if(!is_null($request->valorDeslocamento)){
            $remuneracaoD->valorBeneficio = $request->valorDeslocamento;
        } else $remuneracaoD->valorBeneficio = 0;
        $remuneracaoD->save();

        if($remuneracaoS->save() || $remuneracaoTS->save() || $remuneracaoD->save() || $remuneracaoG->save()){
            return redirect()->back()->with('success', ['Remuneração atualizada com sucesso!']);
        }else{
            return redirect()->back()->with('error', ['Não foi possível atualizar a remuneração!']);
        }
    }
    public function destroy(Remuneracao $remuneracao)
    {
        //
    }
}
