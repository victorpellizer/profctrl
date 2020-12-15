@extends('layouts.layout')

@section('title', 'Eventos')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item">Eventos</li>
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
                        <div class="col-5">
                            <h3>Eventos</h3>
                        </div>  
                        <div class="col-7 text-right">
                            <a class="btn btn-primary" href="eventos/exportCSV">BAIXAR CSV</a>
                            <a class="btn btn-primary" href="eventos/exportXLSX">BAIXAR XLSX</a>
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
                                <td>{{$item->tipoEvento}}</td>
                                <td>{{$item->valorAntigo}}</td>
                                <td>{{$item->valorNovo}}</td>
                                <td>{{$item->regraVigente}}</td>
                                <td>{{$item->usuario}} em {{$item->dataEvento}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @endif
                    <div class="d-flex justify-content-center">
                        {{$eventos->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection