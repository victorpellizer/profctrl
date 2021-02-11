@extends('layouts.layout')

@section('title', 'Busca de docentes')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{action('HomeController@index')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{action('DocenteController@index')}}">Docentes</a></li>
                    <li class="breadcrumb-item">Busca</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="row p-3">
                        <div class="col-6">
                            <h3><i class="fas fa-info-circle" title="Esta tela mostra o resultado da busca da tela de listagem de docentes."></i> Docentes</h3>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <form action="{{url('/docentes/busca')}}" class="w-100" type="get">
                                <div class="row">
                                    <div class="col-9 text-right">
                                        <input name="query" type="search" class="form-control"
                                            placeholder="Buscar docente">
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-primary" type="submit">Buscar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <table class="table table-striped w-100">
                        <thead class="thead-dark">
                            <tr>
                                <th title="Nome completo do docente">Nome</th>
                                <th>Matrícula</th>
                                <th>Cargo</th>
                                <th>Pontos de Desempenho</th>
                                <th>Carga Horária</th>
                                <th>Tempo de Serviço</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        @if(isset($docentes))
                        <tbody>
                            @foreach($docentes as $item)
                            <tr>
                                <td><a href="/docentes/{{$item->idDocente}}">{{$item->nomeDocente}}</a></td>
                                <td>{{$item->matricula}}</td>
                                <td>{{$item->cargo}}</td>
                                <td>{{$item->pontosDeDesempenho}}</td>
                                <td>{{$item->cargaHoraria}}</td>
                                <td>{{$item->tempoDeServico}}</td>
                                <td>{{$item->status}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{$docentes->links()}}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection