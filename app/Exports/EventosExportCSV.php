<?php

namespace App\Exports;

use App\Evento;
use App\TipoEvento;
use App\Regra;
use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EventosExportCSV implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $eventos = Evento::select('*')
            ->orderBy('idEvento', 'desc')
            ->get();
        foreach($eventos as $evento){
            $tipoEvento = TipoEvento::where('idTipoEvento', '=', $evento->TipoEvento_idTipoEvento)
                ->first();
            $user = User::where('id', '=', $evento->Usuario_idUsuario)
                ->first();
            $regraVigente = Regra::select('descricao')
                ->orderBy('dataRegra', 'desc')
                ->first();
            $evento->TipoEvento_idTipoEvento = $tipoEvento['tipoEvento'];
            $evento->Regra_idRegra = $regraVigente['descricao'];
            $evento->dataEvento = $user['name']." em ".$evento->dataEvento;
            $evento->Usuario_idUsuario = "";
        }
        return $eventos;
    }
    public function headings(): array
    {
        return [
            'ID Evento',
            'ID Docente',
            'Tipo de evento',
            'Valor antigo',
            'Valor novo',
            'Lei vigente',
            'Criado por',

            //1 $evento->idEvento
            //2 $evento->idDocente
            //3 $evento->TipoEvento_idTipoEvento
            //4 $evento->valorAntigo
            //5 $evento->valorNovo
            //6 $evento->Regra_idRegra
            //7 $evento->dataEvento
            //8 $evento->Usuario_idUsuario
        ];
    }
}
