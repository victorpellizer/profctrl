@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item">Progressão de Carreira</li>
                    <!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
                </ol>
            </nav>
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    @if(isset($docentes))
                        <h3>Progressão de Carreira</h3>
                        <hr>
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Classe</th>
                                    <th scope="col">Nível</th>
                                    <th scope="col">Remuneração</th>
                                    <th scope="col">Inserir Título</th>
                                    <th scope="col">Inserir Licença</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($docentes as $d)
                                    <tr>
                                        <th scope="row">
                                            <a href="{{route('docente.edit',$d->idDocente)}}">{{$d->nomeDocente}}</a>
                                        </th>
                                        <td>{{$d->classe}}</td>
                                        <td>{{$d->nivel}}</td>
                                        <td>{{$d->remuneracao}}</td>
                                        <td><a href="{{route('docente.create',$d->idDocente)}}"><button type="button" class="btn btn-info"> </button></a></td>
                                        <td><a href="{{route('docente.create',$d->idDocente)}}"><button type="button" class="btn btn-info"> </button></a></td>
                                    </tr>
                                @endforeach()
                            </tbody>
                        </table>
                        <a href="{{route('docente.create')}}"><button type="button" class="btn btn-success">Imprimir relatório</button></a>
                        <a href="{{route('docente.create')}}"><button type="button" class="btn btn-success">Voltar</button></a>
                        <a href="{{route('docente.create')}}"><button type="button" class="btn btn-success">Salvar</button></a>
                        <a href="{{route('docente.create')}}"><button type="button" class="btn btn-success">Cancelar</button></a>

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
