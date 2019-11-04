<?php

namespace App\Http\Controllers;

use App\Titulo;
use Illuminate\Http\Request;

class TituloController extends Controller
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
        return view('titulo.editar')->with(compact('docente'));
    }
    public function update(Request $request, $id)
    {
        $docente = Docente::find($id);
        $idTitulo = $request->idTitulo;
        switch($request->tipoTitulo){
            case 'graduação':
                $idTitulo = 1;
                break;
            case 'curso':
                $idTitulo = 2;
                break;
            default:
                $idTitulo = 0;
        }
        if($idTitulo){
            $newTitulo = new TituloDocente();
            $newTitulo->Titulo_idTitulo = $idLicenca;
            $newTitulo->Docente_idDocente = $docente->idDocente;
        }
        else return redirect()->back()->with('error', ['Não foi possível inserir novo título!']);

        $newTitulo->save();
        return redirect()->back()->with('success', ['Novo título inserido com sucesso!']);
    }
    public function destroy(Funcao $funcao)
    {
        //
    }
}