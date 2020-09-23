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
        $docente->fill($request->all());

        $atualClasse = ClasseDocente::where('Docente_idDocente', '=', $docente->idDocente)
            ->orderBy('dataInicioClasse', 'desc')
            ->first();
        $classe = $atualClasse['Classe_idClasse'];
        $atualNivel = NivelDocente::where('Docente_idDocente', '=', $docente->idDocente)
            ->orderBy('dataInicioNivel', 'desc')
            ->first();
        $nivel = $atualNivel['Nivel_idNivel'];

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
        if($docente->status == 1){
            $docente->status = 0;
            $docente->update();
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

            $atualClasse = ClasseDocente::where('Docente_idDocente', '=', $docente->idDocente)
                ->orderBy('dataInicioClasse', 'desc')
                ->first();
            $classe = $atualClasse['Classe_idClasse'];
            $atualNivel = NivelDocente::where('Docente_idDocente', '=', $docente->idDocente)
                ->orderBy('dataInicioNivel', 'desc')
                ->first();
            $nivel = $atualNivel['Nivel_idNivel'];
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