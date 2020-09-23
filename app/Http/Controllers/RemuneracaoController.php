<?php

namespace App\Http\Controllers;

use App\Classe;
use App\Funcao;
use App\Licenca;
use App\Lotacao;
use App\Nivel;
use App\Titulo;
use App\Docente;
use App\Remuneracao;
use App\ClasseDocente;
use App\FuncaoDocente;
use App\LicencaDocente;
use App\LotacaoDocente;
use App\NivelDocente;
use App\TituloDocente;
use App\User;
use App\Regra;
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

    }
    public function show(Remuneracao $remuneracao)
    {
        //
    }
    public function edit($id)
    {
        $docente = Docente::find($id);
        $idDocente = $docente->idDocente;

        $var = ClasseDocente::where('Docente_idDocente', '=', $idDocente)
            ->orderBy('dataInicioClasse', 'desc')
            ->first();
        $cls = Classe::where('idClasse', '=', $var['Classe_idClasse'])
            ->first();
        if(is_null($cls)){
            $docente->classe = "Não possui";
        } else $docente->classe = $cls['classe'];

        $var = NivelDocente::where('Docente_idDocente', '=', $idDocente)
            ->orderBy('dataInicioNivel', 'desc')
            ->first();
        $nvl = Nivel::where('idNivel', '=', $var['Nivel_idNivel'])
            ->first();
        if(is_null($nvl)){
            $docente->nivel = "Não possui";
        } else $docente->nivel = $nvl['nivel'];

        $beneficioS = Remuneracao::where('tipoBeneficio', '=', 'S')
            ->where('Docente_idDocente', '=', $idDocente)
            ->orderBy('idBeneficio', 'desc')
            ->first();
        if(is_null($beneficioS)){
            $docente->beneficioS = 0;
        } else $docente->beneficioS = $beneficioS->valorBeneficio;

        $beneficioD = Remuneracao::where('tipoBeneficio', '=', 'D')
            ->where('Docente_idDocente', '=', $idDocente)
            ->orderBy('idBeneficio', 'desc')
            ->first();
        if(is_null($beneficioD)){
            $docente->beneficioD = 0;
        } else $docente->beneficioD = $beneficioD->valorBeneficio;

        $beneficioTS = Remuneracao::where('tipoBeneficio', '=', 'TS')
            ->where('Docente_idDocente', '=', $idDocente)
            ->orderBy('idBeneficio', 'desc')
            ->first();
        if(is_null($beneficioTS)){
            $docente->beneficioTS = 0;
        } else $docente->beneficioTS = $beneficioTS->valorBeneficio;

        $beneficioG = Remuneracao::where('tipoBeneficio', '=', 'G')
            ->where('Docente_idDocente', '=', $idDocente)
            ->orderBy('idBeneficio', 'desc')
            ->first();
        if(is_null($beneficioG)){
            $docente->beneficioG = 0;
        } else $docente->beneficioG = $beneficioG->valorBeneficio;

        $docente->beneficioTotal = $docente->beneficioG + $docente->beneficioTS + $docente->beneficioD + $docente->beneficioS;

        $remuneracoes = Remuneracao::where('Docente_idDocente', '=', $idDocente)
            ->orderBy('idBeneficio', 'desc')
            ->get();
        foreach($remuneracoes as $remuneracao){
            $user = User::where('id', '=', $remuneracao['Usuario_idUsuario'])
                ->first();
            $remuneracao->usuario = $user['name'];
            if($remuneracao->tipoBeneficio == 'D'){
                $remuneracao->tipoBeneficio = 'Deslocamento';
            }
            if($remuneracao->tipoBeneficio == 'G'){
                $remuneracao->tipoBeneficio = 'Gratificação';
            }
            if($remuneracao->tipoBeneficio == 'S'){
                $remuneracao->tipoBeneficio = 'Salário';
            }
            if($remuneracao->tipoBeneficio == 'TS'){
                $remuneracao->tipoBeneficio = 'Bônus por T. de Serviço';
            }
        }
        return view('remuneracao.editar')->with(compact('docente','remuneracoes'));
    }
    public function update(Request $request, $id)
    {
        $docente = Docente::find($id);
        $novoDeslocamento = (float)$request->input('beneficioD');
        $novaGratificacao = (float)$request->input('beneficioG');
        //$novoPDD = (int)$request->input('pontosDeDesempenho');
        $idusuario = \Auth::user()->id;

        $var = ClasseDocente::where('Docente_idDocente', '=', $docente->idDocente)
            ->orderBy('dataInicioClasse', 'desc')
            ->first();
        $cls = Classe::where('idClasse', '=', $var['Classe_idClasse'])
            ->first();
        if(is_null($cls)){
            $docente->classe = "Não possui";
        } else $docente->classe = $cls['classe'];

        $var = NivelDocente::where('Docente_idDocente', '=', $docente->idDocente)
            ->orderBy('dataInicioNivel', 'desc')
            ->first();
        $nvl = Nivel::where('idNivel', '=', $var['Nivel_idNivel'])
            ->first();
        if(is_null($nvl)){
            $docente->nivel = "Não possui";
        } else $docente->nivel = $nvl['nivel'];

        $beneficioG = Remuneracao::where('tipoBeneficio', '=', 'G')
            ->where('Docente_idDocente', '=', $docente->idDocente)
            ->orderBy('idBeneficio', 'desc')
            ->first();
        if(is_null($beneficioG)){
            $docente->beneficioG = 0;
        } else $docente->beneficioG = (float)$beneficioG->valorBeneficio;

        $beneficioD = Remuneracao::where('tipoBeneficio', '=', 'D')
            ->where('Docente_idDocente', '=', $docente->idDocente)
            ->orderBy('idBeneficio', 'desc')
            ->first();
        if(is_null($beneficioD)){
            $docente->beneficioD = 0;
        } else $docente->beneficioD = (float)$beneficioD->valorBeneficio;

        if($docente->beneficioG != $novaGratificacao){
            $remuneracaoG = new Remuneracao();
            $remuneracaoG->Docente_idDocente = $docente->idDocente;
            $remuneracaoG->tipoBeneficio = 'G';
            $remuneracaoG->Usuario_idUsuario = $idusuario;
            $remuneracaoG->valorBeneficio = $novaGratificacao;
            $remuneracaoG->save();
        }

        if($docente->beneficioD != $novoDeslocamento){
            $remuneracaoD = new Remuneracao();
            $remuneracaoD->Docente_idDocente = $docente->idDocente;
            $remuneracaoD->tipoBeneficio = 'D';
            $remuneracaoD->Usuario_idUsuario = $idusuario;
            $remuneracaoD->valorBeneficio = $novoDeslocamento;
            $remuneracaoD->save();
        }
        return redirect()->back()->with('success', ['Remuneração atualizada com sucesso!']);
    }
    public function destroy(Remuneracao $remuneracao)
    {
        //
    }
}
