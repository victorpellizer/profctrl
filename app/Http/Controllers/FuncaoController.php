<?php

namespace App\Http\Controllers;

use App\Docente;
use App\Funcao;
use App\FuncaoDocente;
use App\User;
use App\Regra;
use App\Evento;
use Illuminate\Http\Request;

class FuncaoController extends Controller
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
        $var = FuncaoDocente::where('Docente_idDocente', '=', $idDocente)
            ->orderBy('dataInicioFuncao', 'desc')
            ->first();
        $func = Funcao::where('idFuncao', '=', $var['Funcao_idFuncao'])
            ->first();
        if(is_null($func)){
            $docente->funcao = "Não possui";
        } else $docente->funcao = $func['funcao'];

        $funcoes = FuncaoDocente::where('Docente_idDocente', '=', $idDocente)
            ->orderBy('dataInicioFuncao', 'desc')
            ->get();
        foreach($funcoes as $funcao){
            $var = Funcao::where('idFuncao', '=', $funcao['Funcao_idFuncao'])
                ->first();
            $user = User::where('id', '=', $funcao['Usuario_idUsuario'])
                ->first();
            $funcao->usuario = $user['name'];
            $funcao->nome = $var['funcao'];
            $funcao->data = $funcao['dataInicioFuncao'];
        }

        return view('funcao.editar')->with(compact('docente','funcoes'));
    }
    public function update(Request $request, $id)
    {
        $docente = Docente::find($id);
        $novonivel = (int)$request->input('funcao');
        $idusuario = \Auth::user()->id;
        $idDocente = $docente->idDocente;
        $var = FuncaoDocente::where('Docente_idDocente', '=', $idDocente)
            ->orderBy('dataInicioFuncao', 'desc')
            ->first();
        if($var['Funcao_idFuncao'] != $novonivel){
            $newFuncao = new FuncaoDocente();
            $newFuncao->Funcao_idFuncao = $novonivel;
            $newFuncao->Docente_idDocente = $docente->idDocente;
            $newFuncao->Usuario_idUsuario = $idusuario;

            $fncAntiga = Funcao::where('idFuncao', '=', $var['Funcao_idFuncao'])
            ->first();
            $fncNova = Funcao::where('idFuncao', '=', $novonivel)
                ->first();
            $regra = Regra::orderBy('idRegra', 'desc')
                ->first();

            $eventoF = new Evento();
            $eventoF->Docente_idDocente = $docente->idDocente;
            $eventoF->TipoEvento_idTipoEvento = 16;
            $eventoF->valorAntigo = (string)$fncAntiga['funcao'];
            $eventoF->valorNovo = (string)$fncNova['funcao'];
            $eventoF->Regra_idRegra = $regra->idRegra;
            $eventoF->Usuario_idUsuario = $idusuario;
            $eventoF->save();
        }
        else return redirect()->back()->with('error', ['Não foi possível atualizar!']);
        
        $newFuncao->save();
        return redirect()->back()->with('success', ['Função atualizada com sucesso!']);
    }
    public function destroy(Funcao $funcao)
    {
        //
    }
}
