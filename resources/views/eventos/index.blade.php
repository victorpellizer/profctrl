@extends('layouts.layout')

@section('title', 'Eventos')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="width: 100%">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Histórico de eventos</li>
                </ol>
            </nav>

        <br>
        <hr>

        <h5>Histórico de Alterações</h5>
        <table class="table display responsive no-wrap table-striped" style="width: 1000px">
        <thead>
        <tr>
            <th>ID Alteração</th>
            <th>Matrícula</th>
            <th>Nome do Docente</th>
            <th>Alteração feita em</th>
            <th>Novo Valor</th>
            <th>Lei vigente</th>
            <th>Criado por</th>
        </tr>
        </thead>

        <tbody>
             @foreach($eventos as $e)
             <tr>
                <td>{{$e->idEvento}}</td>
                <td>{{$e->matricula}}</td>
                <td>{{$e->nomeDocente}}</td>
                <td>{{$e->tipoEvento}}</td>
                <td>{{$e->valorAbsEvento}}</td>
                <td>{{$e->usuario}} em {{$e->dataEvento}}</td>
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
