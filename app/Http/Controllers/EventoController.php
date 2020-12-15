<?php

namespace App\Http\Controllers;

use App\Evento;
use App\TipoEvento;
use App\Docente;
use App\User;
use App\Regra;
use Illuminate\Http\Request;

use App\Exports\EventosExportCSV;
use App\Exports\EventosExportXLSX;
use Maatwebsite\Excel\Facades\Excel;

class EventoController extends Controller
{
    public function index()
    {
        $eventos = Evento::select('*')
            ->orderBy('idEvento', 'desc')
            ->paginate(50);
        foreach($eventos as $evento){
            $tipoEvento = TipoEvento::where('idTipoEvento', '=', $evento->TipoEvento_idTipoEvento)
                ->first();
            $user = User::where('id', '=', $evento->Usuario_idUsuario)
                ->first();
            $regraVigente = Regra::select('descricao')
                ->orderBy('dataRegra', 'desc')
                ->first();
            $evento->regraVigente = $regraVigente['descricao'];
            $evento->usuario = $user['name'];
            $evento->tipoEvento = $tipoEvento['tipoEvento'];
        }
        return view('eventos.index')->with(compact('eventos'));
    }
    public function exportCSV() 
    {
        return Excel::download(new EventosExportCSV, 'eventos.csv');
    }
    public function exportXLSX() 
    {
        return Excel::download(new EventosExportXLSX, 'eventos.xlsx');
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