<?php

namespace App\Http\Controllers;

use App\Licenca;
use App\Docente;
use App\Regra;
use App\Evento;
use App\User;
use Illuminate\Http\Request;

class LicencaController extends Controller
{
    public function index()
    {
        $licencas = Licenca::all();
        foreach($licencas as $licenca){
            $docente = Docente::where('idDocente', '=', $licenca->Docente_idDocente)
                ->first();
            $licenca->matricula = $docente->matricula;
            $licenca->nomeDocente = $docente->nomeDocente;
            $user = User::where('id', '=', $licenca['Usuario_idUsuario'])
                ->first();
            $licenca->usuario = $user['name'];
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
        $idusuario = \Auth::user()->id;
        $licenca->Usuario_idUsuario = $idusuario;
        if($request->hasFile('arquivo') && $request->file('arquivo')->isValid()){
            $licenca->nomeArquivo = $request->arquivo->getClientOriginalName();
            $upload = $request->arquivo->storeAs('anexos_licencas', $licenca->nomeArquivo);
            if(!$upload){
                return redirect()->back()->with('error', ['Não foi possível inserir!']);
            }
        } else $licenca->nomeArquivo = "Sem arquivo";

        if($licenca->save()){
            $regra = Regra::orderBy('idRegra', 'desc')
                ->first();

            $eventoL = new Evento();
            $eventoL->Docente_idDocente = $licenca->Docente_idDocente;
            $eventoL->TipoEvento_idTipoEvento = 11;
            $eventoL->valorAntigo = (string)"N/A";
            $eventoL->valorNovo = (string)$licenca->nomeLicenca;
            $eventoL->Regra_idRegra = $regra->idRegra;
            $eventoL->Usuario_idUsuario = $idusuario;
            $eventoL->save();
            return redirect()->back()->with('success', ['Licença inserida com sucesso!']);
        } else {
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
            $user = User::where('id', '=', $licenca['Usuario_idUsuario'])
                ->first();
            $licenca->usuario = $user['name'];
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
        $regra = Regra::orderBy('idRegra', 'desc')
            ->first();

        $eventoL = new Evento();
        $eventoL->Docente_idDocente = $licenca->Docente_idDocente;
        $eventoL->TipoEvento_idTipoEvento = 12;
        $eventoL->valorAntigo = (string)$licenca->nomeLicenca;
        $eventoL->valorNovo = (string)"N/A";
        $eventoL->Regra_idRegra = $regra->idRegra;
        $eventoL->Usuario_idUsuario = \Auth::user()->id;
        $eventoL->save();
        $licenca->delete();
        return redirect()->back()->with('success', ['Licença removida com sucesso!']);
    }
    private function validateRequest(){
        return tap(request()->validate([
            'nomeLicenca' => 'required|min:5',
        ]), function(){
            if(request()->hasFile('arquivo')){
                request()->validate([
                    'arquivo' => 'file|max:5000'
                ]);
            }
        });
    }
}