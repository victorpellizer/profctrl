<?php

namespace App\Http\Controllers;

use App\Titulo;
use App\Docente;
use App\Regra;
use App\ClasseDocente;
use App\NivelDocente;
use App\Remuneracao;
use App\Evento;
use Illuminate\Http\Request;

class TituloController extends Controller
{
    public function index()
    {
        $titulos = Titulo::all();
        foreach($titulos as $titulo){
            $docente = Docente::where('idDocente', '=', $titulo->Docente_idDocente)
                ->first();
            $titulo->nomeDocente = $docente->nomeDocente;
            if($titulo->nomeArquivo == 'Sem arquivo'){
                $titulo->anexo = null;
            } else $titulo->anexo = '[anexo]';
        }
        return view('titulos.index')->with(compact('titulos'));
    }
    public function create($id)
    {
        //
    }
    public function store(Request $request)
    {
        $titulo = new Titulo();
        $titulo->fill($request->all());
        $docente = Docente::find($titulo->Docente_idDocente);
        $docente->pontosDeDesempenho += $request->input('pontosDeDesempenhoT');
        $idusuario = \Auth::user()->id;
        $titulo->Usuario_idUsuario = $idusuario;
        if(!$request->pontosDeDesempenhoT){
            $titulo->pontosDeDesempenhoT = 0;
        } else {
            $docente = Docente::find($titulo->Docente_idDocente);
            $docente->pontosDeDesempenho += (int)$request->input('pontosDeDesempenhoT');
            if($docente->pontosDeDesempenho >= 100){
                $docente->pontosDeDesempenho -= 100;

                $atualClasse = ClasseDocente::where('Docente_idDocente', '=', $docente->idDocente)
                    ->orderBy('dataInicioClasse', 'desc')
                    ->first();
                $atualNivel = NivelDocente::where('Docente_idDocente', '=', $docente->idDocente)
                    ->orderBy('dataInicioNivel', 'desc')
                    ->first();
                $nivel = $atualNivel['Nivel_idNivel'];

                $newClasse = new ClasseDocente();
                $newClasse->Classe_idClasse = $atualClasse->Classe_idClasse + 1;
                $newClasse->Docente_idDocente = $docente->idDocente;
                $newClasse->Usuario_idUsuario = 1;
                $newClasse->save();
    
                $regra = Regra::orderBy('idRegra', 'desc')
                    ->first();
                $base = $regra->salarioBase;
                $base2 = $base*2;
                $classeA = ($regra->aumentoClasse/100) + 1;
                $classeB = ($regra->aumentoNivelB/100) + 1;
                $classeC = $classeB * (($regra->aumentoNivelC/100) + 1);
                $classeD = $classeC * (($regra->aumentoNivelD/100) + 1);
                
                $remuneracaoS = new Remuneracao();
                $remuneracaoS->Docente_idDocente = $docente->idDocente;
                $remuneracaoS->tipoBeneficio = 'S';
                $remuneracaoS->Usuario_idUsuario = 1;
                
                if($docente->cargaHoraria == 20){
                    if($nivel == 1) $remuneracaoS->valorBeneficio = $base * pow($classeA,($newClasse->Classe_idClasse - 1));
                    if($nivel == 2) $remuneracaoS->valorBeneficio = $base * pow($classeA,($newClasse->Classe_idClasse - 1)) * $classeB;
                    if($nivel == 3) $remuneracaoS->valorBeneficio = $base * pow($classeA,($newClasse->Classe_idClasse - 1)) * $classeC;
                    if($nivel == 4) $remuneracaoS->valorBeneficio = $base * pow($classeA,($newClasse->Classe_idClasse - 1)) * $classeD;
                }
                else if($docente->cargaHoraria == 40){
                    if($nivel == 1) $remuneracaoS->valorBeneficio = $base2 * pow($classeA,($newClasse->Classe_idClasse - 1));
                    if($nivel == 2) $remuneracaoS->valorBeneficio = $base2 * pow($classeA,($newClasse->Classe_idClasse - 1)) * $classeB;
                    if($nivel == 3) $remuneracaoS->valorBeneficio = $base2 * pow($classeA,($newClasse->Classe_idClasse - 1)) * $classeC;
                    if($nivel == 4) $remuneracaoS->valorBeneficio = $base2 * pow($classeA,($newClasse->Classe_idClasse - 1)) * $classeD;
                }
                else $remuneracaoS->valorBeneficio = 0;
                $remuneracaoS->save();
    
                $remuneracaoTS = new Remuneracao();
                $remuneracaoTS->Docente_idDocente = $docente->idDocente;
                $remuneracaoTS->tipoBeneficio = 'TS';
                $remuneracaoTS->valorBeneficio = $docente->tempoDeServico * (($regra->aumentoTDS/100) + 1) * $remuneracaoS->valorBeneficio / 100;
                $remuneracaoTS->Usuario_idUsuario = 1;
                $remuneracaoTS->save();
            }

            $docente->update();

        }
        if($request->hasFile('arquivo') && $request->file('arquivo')->isValid()){
            $titulo->nomeArquivo = $request->arquivo->getClientOriginalName();
            $upload = $request->arquivo->storeAs('anexos_titulos', $titulo->nomeArquivo);
            if(!$upload){
                return redirect()->back()->with('error', ['Não foi possível inserir!']);
            }
        } else $titulo->nomeArquivo = "Sem arquivo";

        if($titulo->save()){
            $regra = Regra::orderBy('idRegra', 'desc')
                ->first();

            $eventoT = new Evento();
            $eventoT->Docente_idDocente = $titulo->Docente_idDocente;
            $eventoT->TipoEvento_idTipoEvento = 9;
            $eventoT->valorAntigo = (string)"N/A";
            $eventoT->valorNovo = (string)$titulo->nomeTitulo;
            $eventoT->Regra_idRegra = $regra->idRegra;
            $eventoT->Usuario_idUsuario = $idusuario;
            $eventoT->save();
            return redirect()->back()->with('success', ['Titulo inserido com sucesso!']);
        }else{
            return redirect()->back()->with('error', ['Não foi possível inserir!']);
        }
    }
    public function show($id)
    {
        $docente = Docente::find($id);
        $titulos = Titulo::where('Docente_idDocente', '=', $docente->idDocente)
            ->orderBy('dataTitulo', 'desc')
            ->get();
        foreach($titulos as $titulo){
            if($titulo->nomeArquivo == 'Sem arquivo'){
                $titulo->anexo = null;
            } else $titulo->anexo = '[anexo]';
        }
        return view('titulos.show')->with(compact('titulos','docente'));
    }
    public function edit($id)
    {
        $docente = Docente::find($id);
        return view('titulos.novo')->with(compact('docente'));
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        $titulo = Titulo::find($id);
        if($titulo->pontosDeDesempenhoT){
            $docente = Docente::find($titulo->Docente_idDocente);
            $docente->pontosDeDesempenho -= $titulo->pontosDeDesempenhoT;
            if($docente->pontosDeDesempenho < 0){
                $docente->pontosDeDesempenho += 100;

                $atualClasse = ClasseDocente::where('Docente_idDocente', '=', $docente->idDocente)
                    ->orderBy('dataInicioClasse', 'desc')
                    ->first();
                $atualNivel = NivelDocente::where('Docente_idDocente', '=', $docente->idDocente)
                    ->orderBy('dataInicioNivel', 'desc')
                    ->first();
                $nivel = $atualNivel['Nivel_idNivel'];

                $newClasse = new ClasseDocente();
                $newClasse->Classe_idClasse = $atualClasse->Classe_idClasse - 1;
                $newClasse->Docente_idDocente = $docente->idDocente;
                $newClasse->Usuario_idUsuario = 1;
                $newClasse->save();
    
                $regra = Regra::orderBy('idRegra', 'desc')
                    ->first();
                $base = $regra->salarioBase;
                $base2 = $base*2;
                $classeA = ($regra->aumentoClasse/100) + 1;
                $classeB = ($regra->aumentoNivelB/100) + 1;
                $classeC = $classeB * (($regra->aumentoNivelC/100) + 1);
                $classeD = $classeC * (($regra->aumentoNivelD/100) + 1);
                
                $remuneracaoS = new Remuneracao();
                $remuneracaoS->Docente_idDocente = $docente->idDocente;
                $remuneracaoS->tipoBeneficio = 'S';
                $remuneracaoS->Usuario_idUsuario = 1;
                
                if($docente->cargaHoraria == 20){
                    if($nivel == 1) $remuneracaoS->valorBeneficio = $base * pow($classeA,($newClasse->Classe_idClasse - 1));
                    if($nivel == 2) $remuneracaoS->valorBeneficio = $base * pow($classeA,($newClasse->Classe_idClasse - 1)) * $classeB;
                    if($nivel == 3) $remuneracaoS->valorBeneficio = $base * pow($classeA,($newClasse->Classe_idClasse - 1)) * $classeC;
                    if($nivel == 4) $remuneracaoS->valorBeneficio = $base * pow($classeA,($newClasse->Classe_idClasse - 1)) * $classeD;
                }
                else if($docente->cargaHoraria == 40){
                    if($nivel == 1) $remuneracaoS->valorBeneficio = $base2 * pow($classeA,($newClasse->Classe_idClasse - 1));
                    if($nivel == 2) $remuneracaoS->valorBeneficio = $base2 * pow($classeA,($newClasse->Classe_idClasse - 1)) * $classeB;
                    if($nivel == 3) $remuneracaoS->valorBeneficio = $base2 * pow($classeA,($newClasse->Classe_idClasse - 1)) * $classeC;
                    if($nivel == 4) $remuneracaoS->valorBeneficio = $base2 * pow($classeA,($newClasse->Classe_idClasse - 1)) * $classeD;
                }
                else $remuneracaoS->valorBeneficio = 0;
                $remuneracaoS->save();
    
                $remuneracaoTS = new Remuneracao();
                $remuneracaoTS->Docente_idDocente = $docente->idDocente;
                $remuneracaoTS->tipoBeneficio = 'TS';
                $remuneracaoTS->valorBeneficio = $docente->tempoDeServico * (($regra->aumentoTDS/100) + 1) * $remuneracaoS->valorBeneficio / 100;
                $remuneracaoTS->Usuario_idUsuario = 1;
                $remuneracaoTS->save();
            }
            $docente->save();
        }
        $regra = Regra::orderBy('idRegra', 'desc')
            ->first();

        $eventoT = new Evento();
        $eventoT->Docente_idDocente = $titulo->Docente_idDocente;
        $eventoT->TipoEvento_idTipoEvento = 10;
        $eventoT->valorAntigo = (string)$titulo->nomeTitulo;
        $eventoT->valorNovo = (string)"N/A";
        $eventoT->Regra_idRegra = $regra->idRegra;
        $eventoT->Usuario_idUsuario = \Auth::user()->id;
        $eventoT->save();
        $titulo->delete();
        return redirect()->back()->with('success', ['Titulo removido com sucesso!']);
    }
}