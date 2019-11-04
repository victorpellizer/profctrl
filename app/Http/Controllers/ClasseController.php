<?php

namespace App\Http\Controllers;

use App\Classe;
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
        return view('classe.editar')->with(compact('docente'));
    }
    public function update(Request $request, $id)
    {
        $docente = Docente::find($id);
        $classe = new ClasseDocente();
        $classe->fill($request->all());
        $classe->Docente_idDocente = $docente->idDocente;

        if($classe->save()){
            return redirect()->back()->with('success', ['Classe atualizada com sucesso!']);
        }else{
            return redirect()->back()->with('error', ['Não foi possível atualizar!']);
        }
    }
    {
        $docente = Docente::find($id);
        switch($request->nivel){
            case 'A':
                $idNivel = 1;
                break;
            case 'B':
                $idNivel = 2;
                break;
            case 'C':
                $idNivel = 3;
                break;
            case 'D':
                $idNivel = 4;
                break;
            default:
                $idNivel = 0;
        }
        $oldNivel = NivelDocente::where('Docente_idDocente', '=', $id)
            ->orderBy('dataInicioNivel', 'desc')
            ->first();
        if($oldNivel->Nivel_idNivel != $idNivel && $idNivel){
            $newNivel = new NivelDocente();
            $newNivel->Nivel_idNivel = $idNivel;
            $newNivel->Docente_idDocente = $docente->idDocente;
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