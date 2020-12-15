<?php

namespace App\Exports;

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
use App\LotacaoDocente;
use App\NivelDocente;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProgressaoExportXLSX implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $docentes = Docente::select('idDocente','nomeDocente','matricula')
            ->orderBy('idDocente', 'desc')
            ->get();
        foreach ($docentes as $docente) {
            $idDocente = $docente->idDocente;
            $var = ClasseDocente::where('Docente_idDocente', '=', $idDocente)
                ->orderBy('dataInicioClasse', 'desc')
                ->first();
            $cls = Classe::where('idClasse', '=', $var['Classe_idClasse'])
                ->first();
            $docente->classe = $cls['classe'];
            $var = NivelDocente::where('Docente_idDocente', '=', $idDocente)
                ->orderBy('dataInicioNivel', 'desc')
                ->first();
            $nvl = Nivel::where('idNivel', '=', $var['Nivel_idNivel'])
                ->first();
            $docente->nivel = $nvl['nivel'];
            $var = FuncaoDocente::where('Docente_idDocente', '=', $idDocente)
                ->orderBy('dataInicioFuncao', 'desc')
                ->first();
            $func = Funcao::where('idFuncao', '=', $var['Funcao_idFuncao'])
                ->first();
            $docente->funcao = $func['funcao'];

            $var = LotacaoDocente::where('Docente_idDocente', '=', $idDocente)
                ->orderBy('dataInicioLotacao', 'desc')
                ->first();
            $lot = Lotacao::where('idInstituicao', '=', $var['Instituicao_idInstituicao'])
                ->first();
            $docente->lotacao = $lot['nomeInstituicao'];

            $beneficioS = Remuneracao::where('tipoBeneficio', '=', 'S')
                ->where('Docente_idDocente', '=', $idDocente)
                ->orderBy('idBeneficio', 'desc')
                ->first();
            if(is_null($beneficioS))
                $auxS = 0;
            else $auxS = $beneficioS->valorBeneficio;

            $beneficioD = Remuneracao::where('tipoBeneficio', '=', 'D')
                ->where('Docente_idDocente', '=', $idDocente)
                ->orderBy('idBeneficio', 'desc')
                ->first();
            if(is_null($beneficioD))
                $auxD = 0;
            else $auxD = $beneficioD->valorBeneficio;

            $beneficioTS = Remuneracao::where('tipoBeneficio', '=', 'TS')
                ->where('Docente_idDocente', '=', $idDocente)
                ->orderBy('idBeneficio', 'desc')
                ->first();
            if(is_null($beneficioTS))
                $auxTS = 0;
            else $auxTS = $beneficioTS->valorBeneficio;

            $beneficioG = Remuneracao::where('tipoBeneficio', '=', 'G')
                ->where('Docente_idDocente', '=', $idDocente)
                ->orderBy('idBeneficio', 'desc')
                ->first();
            if(is_null($beneficioG))
                $auxG = 0;
            else $auxG = $beneficioG->valorBeneficio;
            $docente->beneficioTotal = $auxG + $auxTS + $auxD + $auxS;
        }
        return $docentes;
    }

    public function headings(): array
    {
        return [
            'ID Docente',
            'Nome docente',
            'Matrícula',
            'Classe',
            'Nível',
            'Função',
            'Lotação',
            'Remuneração'
        ];
    }
}