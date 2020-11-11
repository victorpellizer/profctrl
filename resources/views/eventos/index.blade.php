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
            <div class="card">

                <div class="card-body">
                
                    @if(isset($eventos))
                        <h3>Histórico de eventos <i class="fa fa-info-circle btn btn-secundary" style="float: right"
                                data-toggle="tooltip" data-placement="top"
                                title=""></i>
                        </h3>
                    <table class="table display responsive no-wrap table-striped" style="width: 1000px">
                        <thead>
                            <tr>
                                <th>ID evento</th>
                                <th>ID do docente</th>
                                <th>Tipo de evento</th>
                                <th>Valor antigo</th>
                                <th>Valor novo</th>
                                <th>Lei vigente</th>
                                <th>Criado por</th>
                            </tr>
                        </thead>
                        
                        @foreach($eventos as $item)
                        <tbody style="float: center;background-color: #fff">
                            <th>{{$item->idEvento}}</th>
                            <th>{{$item->Docente_idDocente}}</th>
                            <th>{{$item->tipoEvento}}</th>
                            <th>{{$item->valorAntigo}}</th>
                            <th>{{$item->valorNovo}}</th>
                            <th>{{$item->regraVigente}}</th>
                            <th>{{$item->usuario}} em {{$item->dataEvento}}</th>
                        </tbody>
                        @endforeach
                    
                    </table>
                    @endif
                    <div>
                        {{$eventos->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection