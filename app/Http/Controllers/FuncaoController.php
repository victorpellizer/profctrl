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
        $funcao = new FuncaoDocente();
        $funcao->fill($request->all());
        $funcao->Docente_idDocente = $docente->idDocente;

        if($funcao->save()){
            return redirect()->back()->with('success', ['Função atualizada com sucesso!']);
        }else{
            return redirect()->back()->with('error', ['Não foi possível atualizar!']);
        }
    }
    public function destroy(Funcao $funcao)
    {
        //
    }
}
