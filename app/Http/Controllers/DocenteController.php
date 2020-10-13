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
use App\Regra;
use App\ClasseDocente;
use App\FuncaoDocente;
use App\LicencaDocente;
use App\LotacaoDocente;
use App\NivelDocente;
use App\TituloDocente;
use App\Evento;
use App\User;
use Illuminate\Http\Request;
use Redirect,Response,Config;
use Datatables;
use DB;

class DocenteController extends Controller
{
    public function index()
    {
        $docentes = Docente::all();
        foreach($docentes as $docente){
            if($docente->status == '1'){
                $docente->status = "Ativo";
            } else $docente->status = "Inativo";
        }
        return view('docentes.index')->with(compact('docentes'));
    }
    public function create()
    {
        return view('docentes.novo');
    }
    public function store(Request $request)
    {
		$request->validate([
		'nomeDocente' => ['required', 'string', 'regex:/^[\pL\s\-]+$/u'],
		'matricula' => ['digits_between:6,7', 'required', 'unique:docente,matricula']
        ]);
        $idusuario = \Auth::user()->id;
        $docente = new Docente();
        $docente->fill($request->all());
        $docente->status = 1;
        $docente->pontosDeDesempenho = 0;
        $docente->save();
		//dd($docente);

        $classe = new ClasseDocente();
        $classe->Classe_idClasse = (int)$request->input('classe');
        $classe->Docente_idDocente = $docente->idDocente;
        $classe->Usuario_idUsuario = $idusuario;
        $classe->save();
        //dd($classe);

        $funcao = new FuncaoDocente();
        $funcao->Funcao_idFuncao = (int)$request->input('funcao');
        $funcao->Docente_idDocente = $docente->idDocente;
        $funcao->Usuario_idUsuario = $idusuario;
        $funcao->save();
        //dd($funcao);

        $lotacao = new LotacaoDocente();
        $lotacao->Instituicao_idInstituicao = (int)$request->input('lotacao');
        $lotacao->Docente_idDocente = $docente->idDocente;
        $lotacao->Usuario_idUsuario = $idusuario;
        $lotacao->save();
        //dd($lotacao);

        $nivel = new NivelDocente();
        $nivel->Nivel_idNivel = (int)$request->input('nivel');
        $nivel->Docente_idDocente = $docente->idDocente;
        $nivel->Usuario_idUsuario = $idusuario;
        $nivel->save();
        //dd($nivel);
        
        $regra = Regra::orderBy('idRegra', 'desc')
            ->first();
        $base = $regra->salarioBase;
        $base2 = $base*2;
        $classeA = ($regra->aumentoClasse/100) + 1;
        $classeB = ($regra->aumentoNivelB/100) + 1;
        $classeC = $classeB * (($regra->aumentoNivelC/100) + 1);
        $classeD = $classeC * (($regra->aumentoNivelD/100) + 1);

        $remuneracaoS = new Remuneracao();
        $remuneracaoS->Docente_idDocente = $docente->idDocente;
        $remuneracaoS->tipoBeneficio = 'S';
        $remuneracaoS->Usuario_idUsuario = $idusuario;
        if($docente->cargaHoraria == 20){
            if($nivel->Nivel_idNivel == 1) $remuneracaoS->valorBeneficio = $base * pow($classeA,($classe->Classe_idClasse - 1));
            if($nivel->Nivel_idNivel == 2) $remuneracaoS->valorBeneficio = $base * pow($classeA,($classe->Classe_idClasse - 1)) * $classeB;
            if($nivel->Nivel_idNivel == 3) $remuneracaoS->valorBeneficio = $base * pow($classeA,($classe->Classe_idClasse - 1)) * $classeC;
            if($nivel->Nivel_idNivel == 4) $remuneracaoS->valorBeneficio = $base * pow($classeA,($classe->Classe_idClasse - 1)) * $classeD;
        }
        else if($docente->cargaHoraria == 40){
            if($nivel->Nivel_idNivel == 1) $remuneracaoS->valorBeneficio = $base2 * pow($classeA,($classe->Classe_idClasse - 1));
            if($nivel->Nivel_idNivel == 2) $remuneracaoS->valorBeneficio = $base2 * pow($classeA,($classe->Classe_idClasse - 1)) * $classeB;
            if($nivel->Nivel_idNivel == 3) $remuneracaoS->valorBeneficio = $base2 * pow($classeA,($classe->Classe_idClasse - 1)) * $classeC;
            if($nivel->Nivel_idNivel == 4) $remuneracaoS->valorBeneficio = $base2 * pow($classeA,($classe->Classe_idClasse - 1)) * $classeD;
        }
        else $remuneracaoS->valorBeneficio = 0;
        $remuneracaoS->save();
        //dd($remuneracaoS);

        $remuneracaoTS = new Remuneracao();
        $remuneracaoTS->Docente_idDocente = $docente->idDocente;
        $remuneracaoTS->tipoBeneficio = 'TS';
        $remuneracaoTS->valorBeneficio = $docente->tempoDeServico * (($regra->aumentoTDS/100) + 1) * $remuneracaoS->valorBeneficio / 100;
        $remuneracaoTS->Usuario_idUsuario = $idusuario;
        $remuneracaoTS->save();
        //dd($remuneracaoTS);

        $remuneracaoG = new Remuneracao();
        $remuneracaoG->Docente_idDocente = $docente->idDocente;
        $remuneracaoG->tipoBeneficio = 'G';
        $remuneracaoG->Usuario_idUsuario = $idusuario;
        $remuneracaoG->valorBeneficio = (float)$request->input('beneficioG');
        $remuneracaoG->save();
        //dd($remuneracaoG);

        $remuneracaoD = new Remuneracao();
        $remuneracaoD->Docente_idDocente = $docente->idDocente;
        $remuneracaoD->tipoBeneficio = 'D';
        $remuneracaoD->Usuario_idUsuario = $idusuario;
        $remuneracaoD->valorBeneficio = (float)$request->input('beneficioD');
        $remuneracaoD->save();
        //dd($remuneracaoD);
        
        return redirect()->back()->with('success', ['Cadastrado com sucesso!']);
    }
    public function show($id)
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

        $var = FuncaoDocente::where('Docente_idDocente', '=', $idDocente)
            ->orderBy('dataInicioFuncao', 'desc')
            ->first();
        $func = Funcao::where('idFuncao', '=', $var['Funcao_idFuncao'])
            ->first();
        if(is_null($func)){
                $valor = "Não possui";
        } else $docente->funcao = $func['funcao'];

        $var = LotacaoDocente::where('Docente_idDocente', '=', $idDocente)
            ->orderBy('dataInicioLotacao', 'desc')
            ->first();
        $lot = Lotacao::where('idInstituicao', '=', $var['Instituicao_idInstituicao'])
            ->first();
        if(is_null($lot)){
            $valor = "Não possui";
        } else $docente->lotacao = $lot['nomeInstituicao'];

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
        if($docente->status == '1'){
                $docente->status = "Ativo";
        } else $docente->status = "Inativo";
        return view('docentes.show')->with(compact('docente'));
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

        $var = FuncaoDocente::where('Docente_idDocente', '=', $idDocente)
            ->orderBy('dataInicioFuncao', 'desc')
            ->first();
        $func = Funcao::where('idFuncao', '=', $var['Funcao_idFuncao'])
            ->first();
        if(is_null($func)){
                $valor = "Não possui";
        } else $docente->funcao = $func['funcao'];

        $var = LotacaoDocente::where('Docente_idDocente', '=', $idDocente)
            ->orderBy('dataInicioLotacao', 'desc')
            ->first();
        $lot = Lotacao::where('idInstituicao', '=', $var['Instituicao_idInstituicao'])
            ->first();
        if(is_null($lot)){
            $valor = "Não possui";
        } else $docente->lotacao = $lot['nomeInstituicao'];

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
		
		
        return view('docentes.editar')->with(compact('docente'));
    }
    public function update(Request $request, $id)
    {
		$request->validate([
        'nomeDocente' => ['required', 'string', 'regex:/^[\pL\s\-]+$/u'],
        'matricula' => ['digits_between:6,7', 'required'],
        'pontosDeDesempenho' => ['min:0', 'numeric', 'max:99']
        ]);
        $idusuario = \Auth::user()->id;
        $docente = Docente::find($id);
        $regra = Regra::orderBy('idRegra', 'desc')
            ->first();
        $matricula = $docente->matricula;
        $nome = $docente->nomeDocente;
        $cargo = $docente->cargo;
        $pontosDD = $docente->pontosDeDesempenho;
        $cargaH = $docente->cargaHoraria;
        $tempoDS = $docente->tempoDeServico;
        $docente->fill($request->all());
        if($matricula != $docente->matricula){
            $eventoM = new Evento();
            $eventoM->Docente_idDocente = $docente->idDocente;
            $eventoM->TipoEvento_idTipoEvento = 4;
            $eventoM->valorAntigo = (string)$matricula;
            $eventoM->valorNovo = (string)$docente->matricula;
            $eventoM->Regra_idRegra = $regra->idRegra;
            $eventoM->Usuario_idUsuario = $idusuario;
            $eventoM->save();
        }
        if($nome != $docente->nomeDocente){
            $eventoN = new Evento();
            $eventoN->Docente_idDocente = $docente->idDocente;
            $eventoN->TipoEvento_idTipoEvento = 3;
            $eventoN->valorAntigo = (string)$nome;
            $eventoN->valorNovo = (string)$docente->nomeDocente;
            $eventoN->Regra_idRegra = $regra->idRegra;
            $eventoN->Usuario_idUsuario = $idusuario;
            $eventoN->save();
        }
        if($cargo != $docente->cargo){
            $eventoC = new Evento();
            $eventoC->Docente_idDocente = $docente->idDocente;
            $eventoC->TipoEvento_idTipoEvento = 5;
            $eventoC->valorAntigo = (string)$cargo;
            $eventoC->valorNovo = (string)$docente->cargo;
            $eventoC->Regra_idRegra = $regra->idRegra;
            $eventoC->Usuario_idUsuario = $idusuario;
            $eventoC->save();
        }
        if($pontosDD != $docente->pontosDeDesempenho){
            $eventoP = new Evento();
            $eventoP->Docente_idDocente = $docente->idDocente;
            $eventoP->TipoEvento_idTipoEvento = 8;
            $eventoP->valorAntigo = (string)$pontosDD;
            $eventoP->valorNovo = (string)$docente->pontosDeDesempenho;
            $eventoP->Regra_idRegra = $regra->idRegra;
            $eventoP->Usuario_idUsuario = $idusuario;
            $eventoP->save();
        }
        if($cargaH != $docente->cargaHoraria){
            $eventoCH = new Evento();
            $eventoCH->Docente_idDocente = $docente->idDocente;
            $eventoCH->TipoEvento_idTipoEvento = 6;
            $eventoCH->valorAntigo = (string)$cargaH;
            $eventoCH->valorNovo = (string)$docente->cargaHoraria;
            $eventoCH->Regra_idRegra = $regra->idRegra;
            $eventoCH->Usuario_idUsuario = $idusuario;
            $eventoCH->save();
        }
        if($tempoDS != $docente->tempoDeServico){
            $eventoT = new Evento();
            $eventoT->Docente_idDocente = $docente->idDocente;
            $eventoT->TipoEvento_idTipoEvento = 7;
            $eventoT->valorAntigo = (string)$tempoDS;
            $eventoT->valorNovo = (string)$docente->tempoDeServico;
            $eventoT->Regra_idRegra = $regra->idRegra;
            $eventoT->Usuario_idUsuario = $idusuario;
            $eventoT->save();
        }

        $atualClasse = ClasseDocente::where('Docente_idDocente', '=', $docente->idDocente)
            ->orderBy('dataInicioClasse', 'desc')
            ->first();
        $classe = $atualClasse['Classe_idClasse'];
        $atualNivel = NivelDocente::where('Docente_idDocente', '=', $docente->idDocente)
            ->orderBy('dataInicioNivel', 'desc')
            ->first();
        $nivel = $atualNivel['Nivel_idNivel'];

        $base = $regra->salarioBase;
        $base2 = $base*2;
        $classeA = ($regra->aumentoClasse/100) + 1;
        $classeB = ($regra->aumentoNivelB/100) + 1;
        $classeC = $classeB * (($regra->aumentoNivelC/100) + 1);
        $classeD = $classeC * (($regra->aumentoNivelD/100) + 1);

        $remuneracaoS = new Remuneracao();
        $remuneracaoS->Docente_idDocente = $docente->idDocente;
        $remuneracaoS->tipoBeneficio = 'S';
        $remuneracaoS->Usuario_idUsuario = $idusuario;
        
        if($docente->cargaHoraria == 20){
            if($nivel == 1) $remuneracaoS->valorBeneficio = $base * pow($classeA,($classe - 1));
            if($nivel == 2) $remuneracaoS->valorBeneficio = $base * pow($classeA,($classe - 1)) * $classeB;
            if($nivel == 3) $remuneracaoS->valorBeneficio = $base * pow($classeA,($classe - 1)) * $classeC;
            if($nivel == 4) $remuneracaoS->valorBeneficio = $base * pow($classeA,($classe - 1)) * $classeD;
        }
        else if($docente->cargaHoraria == 40){
            if($nivel == 1) $remuneracaoS->valorBeneficio = $base2 * pow($classeA,($classe - 1));
            if($nivel == 2) $remuneracaoS->valorBeneficio = $base2 * pow($classeA,($classe - 1)) * $classeB;
            if($nivel == 3) $remuneracaoS->valorBeneficio = $base2 * pow($classeA,($classe - 1)) * $classeC;
            if($nivel == 4) $remuneracaoS->valorBeneficio = $base2 * pow($classeA,($classe - 1)) * $classeD;
        }
        else $remuneracaoS->valorBeneficio = 0;
        $remuneracaoS->save();

        $remuneracaoTS = new Remuneracao();
        $remuneracaoTS->Docente_idDocente = $docente->idDocente;
        $remuneracaoTS->tipoBeneficio = 'TS';
        $remuneracaoTS->valorBeneficio = $docente->tempoDeServico * (($regra->aumentoTDS/100) + 1) * $remuneracaoS->valorBeneficio / 100;
        $remuneracaoTS->Usuario_idUsuario = $idusuario;
        $remuneracaoTS->save();

        if($docente->update()){
            return redirect()->back()->with('success', ['Atualizado com sucesso!']);
        }else{
            return redirect()->back()->with('error', ['Não foi possível atualizar!']);
        }
		
    }
    public function destroy($id)
    {
        $docente = Docente::find($id);
        $idusuario = \Auth::user()->id;
        $regra = Regra::orderBy('idRegra', 'desc')
            ->first();



        if($docente->status == 1){
            $docente->status = 0;
            $docente->update();

            $eventoS = new Evento();
            $eventoS->Docente_idDocente = $docente->idDocente;
            $eventoS->TipoEvento_idTipoEvento = 13;
            $eventoS->valorAntigo = (string)1;
            $eventoS->valorNovo = (string)$docente->status;
            $eventoS->Regra_idRegra = $regra->idRegra;
            $eventoS->Usuario_idUsuario = $idusuario;
            $eventoS->save();

            $remuneracaoS = new Remuneracao();
            $remuneracaoS->Docente_idDocente = $docente->idDocente;
            $remuneracaoS->tipoBeneficio = 'S';
            $remuneracaoS->valorBeneficio = 0;
            $remuneracaoS->Usuario_idUsuario = $idusuario;
            $remuneracaoS->save();

            $remuneracaoD = new Remuneracao();
            $remuneracaoD->Docente_idDocente = $docente->idDocente;
            $remuneracaoD->tipoBeneficio = 'D';
            $remuneracaoD->valorBeneficio = 0;
            $remuneracaoD->Usuario_idUsuario = $idusuario;
            $remuneracaoD->save();

            $remuneracaoTS = new Remuneracao();
            $remuneracaoTS->Docente_idDocente = $docente->idDocente;
            $remuneracaoTS->tipoBeneficio = 'TS';
            $remuneracaoTS->valorBeneficio = 0;
            $remuneracaoTS->Usuario_idUsuario = $idusuario;
            $remuneracaoTS->save();

            $remuneracaoG = new Remuneracao();
            $remuneracaoG->Docente_idDocente = $docente->idDocente;
            $remuneracaoG->tipoBeneficio = 'G';
            $remuneracaoG->valorBeneficio = 0;
            $remuneracaoG->Usuario_idUsuario = $idusuario;
            $remuneracaoG->save();

            $lotacao = new LotacaoDocente();
            $lotacao->Instituicao_idInstituicao = 15;
            $lotacao->Docente_idDocente = $docente->idDocente;
            $lotacao->Usuario_idUsuario = $idusuario;
            $lotacao->save();
        } else {
            $docente->status = 1;
            $docente->update();

            $eventoS = new Evento();
            $eventoS->Docente_idDocente = $docente->idDocente;
            $eventoS->TipoEvento_idTipoEvento = 14;
            $eventoS->valorAntigo = (string)0;
            $eventoS->valorNovo = (string)$docente->status;
            $eventoS->Regra_idRegra = $regra->idRegra;
            $eventoS->Usuario_idUsuario = $idusuario;
            $eventoS->save();

            $atualClasse = ClasseDocente::where('Docente_idDocente', '=', $docente->idDocente)
                ->orderBy('dataInicioClasse', 'desc')
                ->first();
            $classe = $atualClasse['Classe_idClasse'];
            $atualNivel = NivelDocente::where('Docente_idDocente', '=', $docente->idDocente)
                ->orderBy('dataInicioNivel', 'desc')
                ->first();
            $nivel = $atualNivel['Nivel_idNivel'];
            $base = $regra->salarioBase;
            $base2 = $base*2;
            $classeA = ($regra->aumentoClasse/100) + 1;
            $classeB = ($regra->aumentoNivelB/100) + 1;
            $classeC = $classeB * (($regra->aumentoNivelC/100) + 1);
            $classeD = $classeC * (($regra->aumentoNivelD/100) + 1);
    
            $remuneracaoS = new Remuneracao();
            $remuneracaoS->Docente_idDocente = $docente->idDocente;
            $remuneracaoS->tipoBeneficio = 'S';
            $remuneracaoS->Usuario_idUsuario = $idusuario;
            
            if($docente->cargaHoraria == 20){
                if($nivel == 1) $remuneracaoS->valorBeneficio = $base * pow($classeA,($classe - 1));
                if($nivel == 2) $remuneracaoS->valorBeneficio = $base * pow($classeA,($classe - 1)) * $classeB;
                if($nivel == 3) $remuneracaoS->valorBeneficio = $base * pow($classeA,($classe - 1)) * $classeC;
                if($nivel == 4) $remuneracaoS->valorBeneficio = $base * pow($classeA,($classe - 1)) * $classeD;
            }
            else if($docente->cargaHoraria == 40){
                if($nivel == 1) $remuneracaoS->valorBeneficio = $base2 * pow($classeA,($classe - 1));
                if($nivel == 2) $remuneracaoS->valorBeneficio = $base2 * pow($classeA,($classe - 1)) * $classeB;
                if($nivel == 3) $remuneracaoS->valorBeneficio = $base2 * pow($classeA,($classe - 1)) * $classeC;
                if($nivel == 4) $remuneracaoS->valorBeneficio = $base2 * pow($classeA,($classe - 1)) * $classeD;
            }
            else $remuneracaoS->valorBeneficio = 0;
            $remuneracaoS->save();
    
            $remuneracaoTS = new Remuneracao();
            $remuneracaoTS->Docente_idDocente = $docente->idDocente;
            $remuneracaoTS->tipoBeneficio = 'TS';
            $remuneracaoTS->valorBeneficio = $docente->tempoDeServico * (($regra->aumentoTDS/100) + 1) * $remuneracaoS->valorBeneficio / 100;
            $remuneracaoTS->Usuario_idUsuario = $idusuario;
            $remuneracaoTS->save();
        }
        return redirect()->back()->with('success', ['Atualizado com sucesso!']);
    }

	public function docenteList()
    {
        $docente = DB::table('docente')->select('*');
        return datatables()->of($docente)
            ->make(true);
    }


}