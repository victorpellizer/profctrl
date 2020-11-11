
@extends('layouts.layout')

@section('title', 'Títulos')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item">Títulos</li>
                    <!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
                </ol>
            </nav>
            <div class="card">
                <div class="card-body"><h3>Lista de Títulos dos Docentes <i class="fa fa-info-circle btn btn-secundary" style="float: right" data-toggle="tooltip" data-placement="top" title="Todas os Títulos de todos os Docentes estão listadas abaixo. Você pode editar elas ao clicar nos nomes dos Docentes. Para adicionar um novo título, entre no perfil de um Docente, clique no botão de Títulos e depois no botão 'Adicionar Título'."></i></h3>
                    <hr>
            <table class="table display responsive no-wrap table-striped">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col" data-toggle="tooltip" data-placement="top" title="Nome completo do Docente.">Nome do docente</th>
                    <th scope="col" data-toggle="tooltip" data-placement="top" title="Matrícula do Docente.">Matrícula</th>
                    <th scope="col" data-toggle="tooltip" data-placement="top" title="Tipo do título.">Tipo de título</th>
                    <th scope="col" data-toggle="tooltip" data-placement="top" title="Descrição do título.">Descrição</th>
                    <th scope="col" data-toggle="tooltip" data-placement="top" title="Pontos de desempenho do título.">Pontos de desempenho</th>
                    <th scope="col" data-toggle="tooltip" data-placement="top" title="Data de validez do título.">Data do título</th>
                    <th scope="col" data-toggle="tooltip" data-placement="top" title="Anexo do título.">Anexo</th>
                    <th scope="col" data-toggle="tooltip" data-placement="top" title="Data de inserção do título.">Inserido por</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($titulos as $t)
                    <tr>
                    <td><a href="{{action('TituloController@show',$t->Docente_idDocente)}}">{{$t->nomeDocente}}</a></td>
                    <td>{{$t->matricula}}</td>
                    <td>{{$t->tipoTitulo}}</td>
                    <td>{{$t->nomeTitulo}}</td>
                    <td>{{$t->pontosDeDesempenhoT}}</td>
                    <td>{{$t->dataTitulo}}</td>
                    <td><a target="_blank" href="{{ url("storage/anexos_titulos/{$t->nomeArquivo}") }}"><img width="40" src="{{asset("storage/anexos_titulos/$t->nomeArquivo")}}"></a></td></td>
                    <td>{{$t->usuario}} em {{$t->dataInsercao}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>

@endsection