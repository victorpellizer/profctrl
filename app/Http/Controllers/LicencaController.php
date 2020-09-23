<?php

namespace App\Http\Controllers;

use App\Licenca;
use App\Docente;
use Illuminate\Http\Request;

class LicencaController extends Controller
{
    public function index()
    {
        $licencas = Licenca::all();
        foreach($licencas as $licenca){
            $docente = Docente::where('idDocente', '=', $licenca->Docente_idDocente)
                ->first();
            $licenca->nomeDocente = $docente->nomeDocente;
            if($licenca->nomeArquivo == 'Sem arquivo'){
                $licenca->anexo = null;
            } else $licenca->anexo = '[anexo]';
        }
        return view('licencas.index')->with(compact('licencas'));
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $licenca = new Licenca();
        $licenca->fill($request->all());

        if($request->hasFile('arquivo') && $request->file('arquivo')->isValid()){
            $licenca->nomeArquivo = $request->arquivo->getClientOriginalName();
            $upload = $request->arquivo->storeAs('anexos_licencas', $licenca->nomeArquivo);
            if(!$upload){
                return redirect()->back()->with('error', ['Não foi possível inserir!']);
            }
        } else $licenca->nomeArquivo = "Sem arquivo";

        if($licenca->save()){
            return redirect()->back()->with('success', ['Licença inserida com sucesso!']);
        }else{
            return redirect()->back()->with('error', ['Não foi possível inserir!']);
        }
    }
    public function show($id)
    {
        $docente = Docente::find($id);
        $licencas = Licenca::where('Docente_idDocente', '=', $docente->idDocente)
            ->orderBy('dataLicenca', 'desc')
            ->get();
        foreach($licencas as $licenca){
            if($licenca->nomeArquivo == 'Sem arquivo'){
                $licenca->anexo = null;
            } else $licenca->anexo = '[anexo]';
        }
        return view('licencas.show')->with(compact('licencas','docente'));
    }
    public function edit($id)
    {
        $docente = Docente::find($id);
        return view('licencas.novo')->with(compact('docente'));
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        $licenca = Licenca::find($id);
        $licenca->delete();
        return redirect()->back()->with('success', ['Licença removida com sucesso!']);
    }
}