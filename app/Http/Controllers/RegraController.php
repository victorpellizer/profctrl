<?php

namespace App\Http\Controllers;


use App\Regra;
use App\User;
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
        $regra = new Regra();
        $regra->fill($request->all());
        //dd($regra);
        $regra->Usuario_idUsuario = \Auth::user()->id;
        if($regra->save()){
            return redirect()->back()->with('success', ['Atualizada com sucesso!']);
        }else{
            return redirect()->back()->with('error', ['Não foi possível atualizar!']);
        }
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