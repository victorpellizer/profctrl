@extends('layouts.app')

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
                                    <th scope="col">Títulos</th>
                                    <th scope="col">Licenças</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($docentes as $d)
                                    <tr>
                                        <th scope="row">
                                            <a href="{{route('progressao.edit',$d->idDocente)}}">{{$d->nomeDocente}}</a>
                                        </th>
                                        <td>
                                        @foreach($d->classes as $c)
                                            {{$c->classe}}
                                        @endforeach()
                                        </td>
                                        <td>
                                        @foreach($d->niveis as $n)
                                            {{$n->nivel}}
                                        @endforeach()
                                        </td>
                                        <td>
                                            {{$d->valorTotalRemuneracao()}}
                                        </td>
                                        <td>
                                        @foreach($d->titulos as $t)
                                            {{$t->titulo}}
                                        @endforeach()
                                        </td>
                                        <td>
                                        @foreach($d->licencas as $l)
                                            {{$l->licenca}}
                                        @endforeach()
                                        </td>
                                    </tr>
                                @endforeach()
                            </tbody>
                        </table>
                        <a href="{{route('docente.create')}}"><button type="button" class="btn btn-success">Imprimir relatório</button></a>
                        <a href="{{route('home')}}"><button type="button" class="btn btn-success">Voltar</button></a>

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
