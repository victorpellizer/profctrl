<?php

namespace App\Http\Controllers;

use App\Remuneracao;
use Illuminate\Http\Request;

class RemuneracaoController extends Controller
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
        $remuneracao = new Remuneracao();
        $remuneracao->fill($request->all());
        if($remuneracao->save()){
            return redirect()->back()->with('success', ['Remuneração atualizada com sucesso!']);
        }else{
            return redirect()->back()->with('error', ['Não foi possível atualizar a remuneração!']);
        }
    }

    public function show(Remuneracao $remuneracao)
    {
        //
    }
    public function edit($id)
    {
        $remuneracao = Remuneracao::find($id);

        return view('remuneracao.editar')->with(compact('remuneracao'));
    }

    public function update(Request $request, Remuneracao $remuneracao)
    {
        //
    }
    public function destroy(Remuneracao $remuneracao)
    {
        //
    }
}
