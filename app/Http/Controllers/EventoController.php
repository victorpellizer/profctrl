<?php

namespace App\Http\Controllers;

use App\Evento;
use App\TipoEvento;
use App\Docente;
use App\User;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function index()
    {
        $eventos = Evento::all();
        foreach($eventos as $evento){
            $docente = Docente::where('idDocente', '=', $evento->docente_idDocente)
                ->first();
            $user = User::where('id', '=', $evento->Usuario_idUsuario)
                ->first();
            $evento->matricula = $docente['matricula'];
            $evento->nomeDocente = $docente['nomeDocente'];
            if($evento->idEvento == 1){
                $evento->tipoEvento = "Classe";
            }
            if($evento->idEvento == 2){
                $evento->tipoEvento = "Nível";
            }
            if($evento->idEvento == 3){
                $evento->tipoEvento = "Tempo de Serviço";
            }
            if($evento->idEvento == 4){
                $evento->tipoEvento = "Deslocamento";
            }
            if($evento->idEvento == 5){
                $evento->tipoEvento = "Alteração de classe";
            }
            if($evento->idEvento == 6){
                $evento->tipoEvento = "Alteração de classe";
            }
            $evento->usuario = $user['name'];
        }
        return view('eventos.index')->with(compact('eventos'));
    }
    public function create($id)
    {
        //
    }
    public function store(Request $request)
    {
        //
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
       //
    }
}