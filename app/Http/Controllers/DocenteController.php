<?php

namespace App\Http\Controllers;

use App\Docente;
use Illuminate\Http\Request;
use DB;

class DocenteController extends Controller
{
    public function index()
    {
        $docente = new Docente();
        $docentes = $docente->all();
        return view('docentes.index')->with(compact('docentes'));
    }
    public function create()
    {
        return view('docentes.novo');
    }
    public function store(Request $request)
    {
        $docente = new Docente();
        $docente->fill($request->all());
        $docente->status = 1;
        if(!$docente->classe)
            $docente->classe = 1;
        if(!$docente->nivel)
            $docente->nivel = 'A';
        if(!$docente->funcao)
            $docente->funcao = 'Docente';
        if(!$docente->cargo)
            $docente->cargo = 'Professor';

        $cidade = DB::table('cidade')->where('nomeCidade','like',$request->cidade)->first();

        $docente->cidadeIdCidade=$cidade->idCidade;
        if($docente->save()){
            return redirect()->back()->with('success', ['Cadastrado com sucesso!']);

        }else{
            return redirect()->back()->with('error', ['Não foi possível cadastrar!']);
        }
    }
    public function show(Docente $docente)
    {
        //
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
