<?php

namespace App\Exports;

use App\Docente;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DocentesExportCSV implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $docentes = Docente::all();
        foreach ($docentes as $docente) {
            $docente->CidadeIdCidade = "";
            if ($docente->status == 1) {
                $docente->status = "Ativo";
            }
            else $docente->status = "Inativo";
        }

        return $docentes;
    }
    public function headings(): array
    {
        return [
            'ID Docente',
            'Nome docente',
            'Matrícula',
            'Cargo',
            'Carga horária',
            'Bonus por tempo de serviço',
            'Pontos de Desempenho',
            'Status',
        ];
    }
}