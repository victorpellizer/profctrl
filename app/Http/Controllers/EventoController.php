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