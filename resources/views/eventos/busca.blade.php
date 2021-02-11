@extends('layouts.layout')

@section('title', 'Busca eventos')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="/eventos">Eventos</a></li>
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
                            <h3><i class="fas fa-info-circle"
                                    title="Esta tela mostra o resultado da busca da tela de listagem de eventos."></i>
                                Eventos</h3>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <form action="{{url('/eventos/busca')}}" class="w-100" type="get">
                                <div class="row">
                                    <div class="col-9 text-right">
                                        <input name="query" type="search" class="form-control"
                                            placeholder="Buscar evento">
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
                                <th>Id evento</th>
                                <th>Id do docente</th>
                                <th>Tipo de evento</th>
                                <th>Valor antigo</th>
                                <th>Valor novo</th>
                                <th>Lei vigente</th>
                                <th>Criado por</th>
                            </tr>
                        </thead>
                        @if(isset($eventos))
                        <tbody>
                            @foreach($eventos as $item)
                            <tr>
                                <td>{{$item->idEvento}}</td>
                                <td>{{$item->Docente_idDocente}}</td>
                                <td>{{$item->TipoEvento_idTipoEvento}}</td>
                                <td>{{$item->valorAntigo}}</td>
                                <td>{{$item->valorNovo}}</td>
                                <td>{{$item->Regra_idRegra}}</td>
                                <td>{{$item->Usuario_idUsuario}} em {{$item->dataEvento}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{$eventos->links()}}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection