<?php

namespace App\Http\Controllers;

use App\Nivel;
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
        return view('nivel.editar')->with(compact('docente'));
    }
    public function update(Request $request, $id)
    {
        $docente = Docente::find($id);
        $idNivel = $request->idNivel;
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
