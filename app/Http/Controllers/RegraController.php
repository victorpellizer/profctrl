<?php

namespace App\Http\Controllers;


use App\Regra;
use App\User;
use App\Evento;
use Illuminate\Http\Request;

class RegraController extends Controller
{
    public function index()
    {
        $regra = Regra::orderBy('idRegra', 'desc')
            ->first();
        $regra->valorDeslocamento = round(($regra->deslocamento/100) * $regra->salarioBase,2);
        $regra->valorGratificacao1 = round(($regra->gratificacao1/100) * $regra->salarioBase,2);
        $regra->valorGratificacao2 = round(($regra->gratificacao2/100) * $regra->salarioBase,2);
        $regra->valorGratificacao3 = round(($regra->gratificacao3/100) * $regra->salarioBase,2);
        $regra->valorGratificacao4 = round(($regra->gratificacao4/100) * $regra->salarioBase,2);
        $regra->valorGratificacao5 = round(($regra->gratificacao5/100) * $regra->salarioBase,2);
        $regra->aumentoTDS = $regra->aumentoTDS * 5;
        $user = User::where('id', '=', $regra->Usuario_idUsuario)
            ->first();
        $regra->usuario = $user['name'];
        return view('regra.index')->with(compact('regra'));
    }
    public function create()
    {
        return view('regra.novo');
    }
    public function store(Request $request)
    {
        $idusuario = \Auth::user()->id;
        $regra = new Regra();
        $regra->fill($request->all());
        $regra->Usuario_idUsuario = $idusuario;
        $regra->save();
        
        $regraAntiga = Regra::where('idRegra', '=', $regra->idRegra-1)
            ->first();
    
        $eventoT = new Evento();
        $eventoT->Docente_idDocente = 96;
        $eventoT->TipoEvento_idTipoEvento = 19;
        $eventoT->valorAntigo = (string)$regraAntiga->idRegra;
        $eventoT->valorNovo = (string)$regra->idRegra;
        $eventoT->Regra_idRegra = $regra->idRegra;
        $eventoT->Usuario_idUsuario = $idusuario;
        $eventoT->save();

        return redirect()->back()->with('success', ['Atualizada com sucesso!']);
    }
    public function show(Funcao $funcao)
    {
        //
    }
    public function edit($id)
    {

    }
    public function update(Request $request, $id)
    {

    }
    public function destroy(Funcao $funcao)
    {
        //
    }
}