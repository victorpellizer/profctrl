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
        $idClasse = $request->classe;
        //$idClasse = $request->idClasse;

        $oldClasse = ClasseDocente::where('Docente_idDocente', '=', $id)
            ->orderBy('dataInicioClasse', 'desc')
            ->first();
        if($oldClasse->Classe_idClasse != $idClasse && $idClasse){
            $newClasse = new ClasseDocente();
            $newClasse->Classe_idClasse = $idClasse;
            $newClasse->Docente_idDocente = $docente->idDocente;
        }
        else return redirect()->back()->with('error', ['Não foi possível atualizar!']);

        $newNivel->save();
        return redirect()->back()->with('success', ['Classe atualizada com sucesso!']);
    }

    public function destroy(Funcao $funcao)
    {
        //
    }
}