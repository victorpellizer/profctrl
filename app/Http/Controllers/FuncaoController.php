<?php

namespace App\Http\Controllers;

use App\Funcao;
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
        return view('funcao.editar')->with(compact('docente'));
    }
    public function update(Request $request, $id)
    {
        $docente = Docente::find($id);
        $idFuncao = $request->idFuncao;
        switch($request->funcao){
            case 'Docencia':
                $idFuncao = 1;
                break;
            case 'Docencia no AEE':
                $idFuncao = 2;
                break;
            case 'Direcao de instituicao educacional':
                $idFuncao = 3;
                break;
            case 'Direcao aux de instituicao educacional':
                $idFuncao = 4;
                break;
            case 'Coordenacao pedagogica':
                $idFuncao = 5;
                break;
            case 'Coordenacao educacional':
                $idFuncao = 6;
                break;
            default:
                $idFuncao = 0;
        }
        $oldFuncao = FuncaoDocente::where('Docente_idDocente', '=', $id)
            ->orderBy('dataInicioFuncao', 'desc')
            ->first();
        if($oldFuncao->Funcao_idFuncao != $idFuncao && $idFuncao){
            $newFuncao = new FuncaoDocente();
            $newFuncao->Funcao_idFuncao = $idNivel;
            $newFuncao->Docente_idDocente = $docente->idDocente;
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
