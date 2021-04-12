<?php

namespace App\Http\Controllers;

use App\Nivel;
use App\NivelDocente;
use App\Classe;
use App\ClasseDocente;
use App\Docente;
use App\Remuneracao;
use App\User;
use App\Regra;
use App\Evento;
use Illuminate\Http\Request;

class NivelController extends Controller
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
        $var = NivelDocente::where('Docente_idDocente', '=', $idDocente)
            ->orderBy('dataInicioNivel', 'desc')
            ->first();
        $nvl = Nivel::where('idNivel', '=', $var['Nivel_idNivel'])
            ->first();
        if(is_null($nvl)){
            $docente->nivel = "Não possui";
        } else $docente->nivel = $nvl['nivel'];

        $niveis = NivelDocente::where('Docente_idDocente', '=', $idDocente)
            ->orderBy('dataInicioNivel', 'desc')
            ->get();
        foreach($niveis as $nivel){
            $var = Nivel::where('idNivel', '=', $nivel['Nivel_idNivel'])
                ->first();
            $user = User::where('id', '=', $nivel['Usuario_idUsuario'])
                ->first();
            $nivel->usuario = $user['name'];
            $nivel->nome = $var['nivel'];
            $nivel->data = date('d/m/Y à\s H:i:s', strtotime($nivel['dataInicioNivel']));
        }

        return view('nivel.editar')->with(compact('docente','niveis'));
    }

    public function update(Request $request, $id)
    {
        $docente = Docente::find($id);
        $novonivel = (int)$request->input('nivel');
        $idDocente = $docente->idDocente;
        $atualNivel = NivelDocente::where('Docente_idDocente', '=', $idDocente)
            ->orderBy('dataInicioNivel', 'desc')
            ->first();

        $atualClasse = ClasseDocente::where('Docente_idDocente', '=', $docente->idDocente)
            ->orderBy('dataInicioClasse', 'desc')
            ->first();
        $docente->classe = $atualClasse['Classe_idClasse'];
        $idusuario = \Auth::user()->id;

        if($atualNivel['Nivel_idNivel'] != $novonivel){
            $newNivel = new NivelDocente();
            $newNivel->Nivel_idNivel = $novonivel;
            $newNivel->Docente_idDocente = $docente->idDocente;
            $newNivel->Usuario_idUsuario = $idusuario;

            $regra = Regra::orderBy('idRegra', 'desc')
                ->first();
            $base = $regra->salarioBase;
            $base2 = $base*2;
            $classeA = ($regra->aumentoClasse/100) + 1;
            $classeB = ($regra->aumentoNivelB/100) + 1;
            $classeC = $classeB * (($regra->aumentoNivelC/100) + 1);
            $classeD = $classeC * (($regra->aumentoNivelD/100) + 1);

            $nvlAntigo = Nivel::where('idNivel', '=', $atualNivel['Nivel_idNivel'])
                ->first();
            $nvlNovo = Nivel::where('idNivel', '=', $novonivel)
                ->first();

            $eventoN = new Evento();
            $eventoN->Docente_idDocente = $docente->idDocente;
            $eventoN->TipoEvento_idTipoEvento = 2;
            $eventoN->valorAntigo = (string)$nvlAntigo['nivel'];
            $eventoN->valorNovo = (string)$nvlNovo['nivel'];
            $eventoN->Regra_idRegra = $regra->idRegra;
            $eventoN->Usuario_idUsuario = $idusuario;
            $eventoN->save();

            $remuneracaoS = new Remuneracao();
            $remuneracaoS->Docente_idDocente = $docente->idDocente;
            $remuneracaoS->tipoBeneficio = 'S';
            $remuneracaoS->Usuario_idUsuario = $idusuario;
            
            if($docente->cargaHoraria == 20){
                if($novonivel == 1) $remuneracaoS->valorBeneficio = $base * pow($classeA,($docente->classe - 1));
                if($novonivel == 2) $remuneracaoS->valorBeneficio = $base * pow($classeA,($docente->classe - 1)) * $classeB;
                if($novonivel == 3) $remuneracaoS->valorBeneficio = $base * pow($classeA,($docente->classe - 1)) * $classeC;
                if($novonivel == 4) $remuneracaoS->valorBeneficio = $base * pow($classeA,($docente->classe - 1)) * $classeD;
            }
            else if($docente->cargaHoraria == 40){
                if($novonivel == 1) $remuneracaoS->valorBeneficio = $base2 * pow($classeA,($docente->classe - 1));
                if($novonivel == 2) $remuneracaoS->valorBeneficio = $base2 * pow($classeA,($docente->classe - 1)) * $classeB;
                if($novonivel == 3) $remuneracaoS->valorBeneficio = $base2 * pow($classeA,($docente->classe - 1)) * $classeC;
                if($novonivel == 4) $remuneracaoS->valorBeneficio = $base2 * pow($classeA,($docente->classe - 1)) * $classeD;
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

        $newNivel->save();
        return redirect()->back()->with('success', ['Nível atualizado com sucesso!']);
    }
    public function destroy(Funcao $funcao)
    {
        //
    }
}
