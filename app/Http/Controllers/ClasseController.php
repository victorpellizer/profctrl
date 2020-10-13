<?php

namespace App\Http\Controllers;


use App\Remuneracao;
use App\Nivel;
use App\NivelDocente;
use App\Classe;
use App\Docente;
use App\ClasseDocente;
use App\User;
use App\Regra;
use App\Evento;
use Illuminate\Http\Request;

class ClasseController extends Controller
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
        //
    }
    public function show(Funcao $funcao)
    {
        //
    }
    public function edit($id)
    {
        $docente = Docente::find($id);
        $idDocente = $docente->idDocente;
        $var = ClasseDocente::where('Docente_idDocente', '=', $idDocente)
            ->orderBy('dataInicioClasse', 'desc')
            ->first();
        $cls = Classe::where('idClasse', '=', $var['Classe_idClasse'])
            ->first();
        if(is_null($cls)){
            $docente->classe = "Não possui";
        } else $docente->classe = $cls['classe'];

        $classes = ClasseDocente::where('Docente_idDocente', '=', $idDocente)
            ->orderBy('dataInicioClasse', 'desc')
            ->get();
        foreach($classes as $classe){
            $var = Classe::where('idClasse', '=', $classe['Classe_idClasse'])
                ->first();
            $user = User::where('id', '=', $classe['Usuario_idUsuario'])
                ->first();
            $classe->usuario = $user['name'];
            $classe->nome = $var['classe'];
            $classe->data = $classe['dataInicioClasse'];
        }

        return view('classe.editar')->with(compact('docente','classes'));
    }
    public function update(Request $request, $id)
    {
        $docente = Docente::find($id);
        $novaclasse = (int)$request->input('classe');
        $idDocente = $docente->idDocente;
        $atualClasse = ClasseDocente::where('Docente_idDocente', '=', $idDocente)
            ->orderBy('dataInicioClasse', 'desc')
            ->first();

        $atualNivel = NivelDocente::where('Docente_idDocente', '=', $idDocente)
            ->orderBy('dataInicioNivel', 'desc')
            ->first();
        $docente->nivel = $atualNivel['Nivel_idNivel'];


        /*if($atualClasse['Classe_idClasse'] - $novaclasse > 1 || $atualClasse['Classe_idClasse'] - $novaclasse < -1){
            return redirect()->back()->with('error', ['A classe só pode ser alterada de um em um!']);
        }*/
        $idusuario = \Auth::user()->id;
        if($atualClasse['Classe_idClasse'] != $novaclasse){
            $newClasse = new ClasseDocente();
            $newClasse->Classe_idClasse = $novaclasse;
            $newClasse->Docente_idDocente = $docente->idDocente;
            $newClasse->Usuario_idUsuario = $idusuario;

            $regra = Regra::orderBy('idRegra', 'desc')
                ->first();
            $base = $regra->salarioBase;
            $base2 = $base*2;
            $classeA = ($regra->aumentoClasse/100) + 1;
            $classeB = ($regra->aumentoNivelB/100) + 1;
            $classeC = $classeB * (($regra->aumentoNivelC/100) + 1);
            $classeD = $classeC * (($regra->aumentoNivelD/100) + 1);
            //dd($regra);

            $clsAntiga = Classe::where('idClasse', '=', $atualClasse['Classe_idClasse'])
                ->first();
            $clsNova = Classe::where('idClasse', '=', $novaclasse)
                ->first();

            $eventoC = new Evento();
            $eventoC->Docente_idDocente = $docente->idDocente;
            $eventoC->TipoEvento_idTipoEvento = 1;
            $eventoC->valorAntigo = (string)$clsAntiga['classe'];
            $eventoC->valorNovo = (string)$clsNova['classe'];
            $eventoC->Regra_idRegra = $regra->idRegra;
            $eventoC->Usuario_idUsuario = $idusuario;
            $eventoC->save();

            $remuneracaoS = new Remuneracao();
            $remuneracaoS->Docente_idDocente = $docente->idDocente;
            $remuneracaoS->tipoBeneficio = 'S';
            $remuneracaoS->Usuario_idUsuario = $idusuario;
            
            if($docente->cargaHoraria == 20){
                if($docente->nivel == 1) $remuneracaoS->valorBeneficio = $base * pow($classeA,($newClasse->Classe_idClasse - 1));
                if($docente->nivel == 2) $remuneracaoS->valorBeneficio = $base * pow($classeA,($newClasse->Classe_idClasse - 1)) * $classeB;
                if($docente->nivel == 3) $remuneracaoS->valorBeneficio = $base * pow($classeA,($newClasse->Classe_idClasse - 1)) * $classeC;
                if($docente->nivel == 4) $remuneracaoS->valorBeneficio = $base * pow($classeA,($newClasse->Classe_idClasse - 1)) * $classeD;
            }
            else if($docente->cargaHoraria == 40){
                if($docente->nivel == 1) $remuneracaoS->valorBeneficio = $base2 * pow($classeA,($newClasse->Classe_idClasse - 1));
                if($docente->nivel == 2) $remuneracaoS->valorBeneficio = $base2 * pow($classeA,($newClasse->Classe_idClasse - 1)) * $classeB;
                if($docente->nivel == 3) $remuneracaoS->valorBeneficio = $base2 * pow($classeA,($newClasse->Classe_idClasse - 1)) * $classeC;
                if($docente->nivel == 4) $remuneracaoS->valorBeneficio = $base2 * pow($classeA,($newClasse->Classe_idClasse - 1)) * $classeD;
            }
            else $remuneracaoS->valorBeneficio = 0;
            $remuneracaoS->save();

            $remuneracaoTS = new Remuneracao();
            $remuneracaoTS->Docente_idDocente = $docente->idDocente;
            $remuneracaoTS->tipoBeneficio = 'TS';
            $remuneracaoTS->valorBeneficio = $docente->tempoDeServico * (($regra->aumentoTDS/100) + 1) * $remuneracaoS->valorBeneficio / 100;
            $remuneracaoTS->Usuario_idUsuario = $idusuario;
            $remuneracaoTS->save();
        }
        else return redirect()->back()->with('error', ['Não foi possível atualizar!']);

        $newClasse->save();
        return redirect()->back()->with('success', ['Classe atualizada com sucesso!']);
    }

    public function destroy(Funcao $funcao)
    {
        //
    }
}