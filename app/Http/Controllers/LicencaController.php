<?php

namespace App\Http\Controllers;

use App\Licenca;
use Illuminate\Http\Request;

class LicencaController extends Controller
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
        return view('licenca.editar')->with(compact('docente'));
    }
    public function update(Request $request, $id)
    {
        $docente = Docente::find($id);
        $idLicenca = $request->idLicenca;
        switch($request->tipoLicenca){
            case 'Afastamento':
                $idLicenca = 1;
                break;
            case 'Maternidade':
                $idLicenca = 2;
                break;
            case 'Atestado':
                $idLicenca = 3;
                break;
            default:
                $idLicenca = 0;
        }
        if($idLicenca){
            $newLicenca = new LicencaDocente();
            $newLicenca->Licenca_idLicenca = $idLicenca;
            $newLicenca->Docente_idDocente = $docente->idDocente;
        }
        else return redirect()->back()->with('error', ['Não foi possível inserir nova licença!']);

        $newLicenca->save();
        return redirect()->back()->with('success', ['Nova licença inserida com sucesso!']);
    }
    public function destroy(Funcao $funcao)
    {
        //
    }
}