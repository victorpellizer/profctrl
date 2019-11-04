<?php

namespace App\Http\Controllers;

use App\Lotacao;
use Illuminate\Http\Request;

class LotacaoController extends Controller
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
        return view('lotacao.editar')->with(compact('docente'));
    }
    public function update(Request $request, $id)
    {
        $docente = Docente::find($id);
        switch($request->nomeInstituicao){
            case 'Betânia':
                $idInstituicao = 1;
                break;
            case 'Tônia Harms':
                $idInstituicao = 2;
                break;
            case 'GERALDA HARMS':
                $idInstituicao = 3;
                break;
            case 'FÁTIMA A. BOSA':
                $idInstituicao = 4;
                break;
            case 'CANAÃ':
                $idInstituicao = 5;
                break;
            case 'LIPO GRANDE':
                $idInstituicao = 6;
                break;
            case 'SÃO JUDAS TADEU':
                $idInstituicao = 7;
                break;
            case 'JOSÉ P. N. ROSAS':
                $idInstituicao = 8;
                break;
            case 'SMEC':
                $idInstituicao = 9;
                break;
            case 'STA RITA DE CÁSSIA':
                $idInstituicao = 10;
                break;
            case 'THERESA G. SEIFARTH':
                $idInstituicao = 11;
                break;
            case 'SANTA CRUZ':
                $idInstituicao = 12;
                break;
            case 'DEP. ALIM. ESC':
                $idInstituicao = 13;
                break;
            case 'BIBLIOTECA':
                $idInstituicao = 14;
                break;
            default:
                $idInstituicao = 0;
        }
        $oldInstituicao = LotacaoDocente::where('Docente_idDocente', '=', $id)
            ->orderBy('dataInicioLotacao', 'desc')
            ->first();
        if($oldInstituicao->Instituicao_idInstituicao != $idInstituicao && $idInstituicao){
            $newInstituicao = new LotacaoDocente();
            $newInstituicao->Instituicao_idInstituicao = $idInstituicao;
            $newInstituicao->Docente_idDocente = $docente->idDocente;
        }
        else return redirect()->back()->with('error', ['Não foi possível inserir nova licença!']);

        $newInstituicao->save();
        return redirect()->back()->with('success', ['Lotação atualizada com sucesso!']);
    }
    public function destroy(Funcao $funcao)
    {
        //
    }
}
