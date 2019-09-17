<?php

namespace App\Http\Controllers;

use App\Classe;
use App\Funcao;
use App\Licenca;
use App\Lotacao;
use App\Nivel;
use App\Titulo;
use App\Docente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ProgressaoController extends Controller
{
    public function create()
    {
        //
    }
    public function index()
    {
        $docente = new Docente();
        $docentes = $docente->all();
        $classe = new Classe();
        $classes = $classe->all();
        $nivel = new Nivel();
        $niveis = $nivel->all();
        
        return view('progressao.index')
            ->with(compact('docentes'))
            ->with(compact('niveis'))
            ->with(compact('classes'));
    }
    public function show(Docente $docente)
    {
        //
    }
    public function store(Request $request)
    {
        $docente = new Docente();
        $docente->fill($request->all());
        if($docente->save()){
            return redirect()->back()->with('success', ['Progressão atualizada com sucesso!']);
        }else{
            return redirect()->back()->with('error', ['Não foi possível atualizar a progressão!']);
        }
    }
    public function edit($id)
    {
        $docente = Docente::find($id);

        return view('docentes.editar')->with(compact('docente'));
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
