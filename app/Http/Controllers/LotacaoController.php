<?php

namespace App\Http\Controllers;

use App\Docente;
use App\Lotacao;
use App\LotacaoDocente;
use App\User;
use Illuminate\Http\Request;

class LotacaoController extends Controller
{
    public function index()
    {
        
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
        $idDocente = $docente->idDocente;

        $var = LotacaoDocente::where('Docente_idDocente', '=', $idDocente)
            ->orderBy('dataInicioLotacao', 'desc')
            ->first();
        $lot = Lotacao::where('idInstituicao', '=', $var['Instituicao_idInstituicao'])
            ->first();
        if(is_null($lot)){
                $docente->lotacao = "Não possui";
            } else $docente->lotacao = $lot['nomeInstituicao'];
        $lotacoes = LotacaoDocente::where('Docente_idDocente', '=', $idDocente)
            ->orderBy('dataInicioLotacao', 'desc')
            ->get();
        foreach($lotacoes as $lotacao){
            $var = Lotacao::where('idInstituicao', '=', $lotacao['Instituicao_idInstituicao'])
                ->first();
            $user = User::where('id', '=', $lotacao['Usuario_idUsuario'])
                ->first();
            $lotacao->usuario = $user['name'];
            $lotacao->nome = $var['nomeInstituicao'];
            $lotacao->data = $lotacao['dataInicioLotacao'];
            
        }
        return view('lotacao.editar')->with(compact('docente','lotacoes'));
    }
    public function update(Request $request, $id)
    {
        $docente = Docente::find($id);
        $novalotacao = (int)$request->input('lotacao');
        $idDocente = $docente->idDocente;
        $idusuario = \Auth::user()->id;
        $var = LotacaoDocente::where('Docente_idDocente', '=', $idDocente)
            ->orderBy('dataInicioLotacao', 'desc')
            ->first();
        if($var['Instituicao_idInstituicao'] != $novalotacao){
            $newLotacao = new LotacaoDocente();
            $newLotacao->Instituicao_idInstituicao = $novalotacao;
            $newLotacao->Docente_idDocente = $docente->idDocente;
            $newLotacao->Usuario_idUsuario = $idusuario;
        }
        else return redirect()->back()->with('error', 'Não foi possível atualizar!');

        $newLotacao->save();
        return redirect()->back()->with('success', 'Lotação atualizada com sucesso!');
        
    }
    public function destroy(Funcao $funcao)
    {
        //
    }
}
