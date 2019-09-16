@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item">Docentes</li>
                    <!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
                </ol>
            </nav>
            <div class="card">
                <div class="card-header">Docentes</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    @if(isset($docentes))
                        <h3>Lista de Docentes</h3>
                        <hr>
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Opções</th>
                                    <th scope="col">Matricula</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Cargo</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Pontos de Desempenho</th>
                                    <th scope="col">Carga Horaria</th>
                                    <th scope="col">Tempo de Servico</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach($docentes as $d)
                                    <tr>
                                        <th>
                                            <a href="{{route('docente.edit',$d->idDocente)}}"><button type="button" class="btn btn-warning">Editar</button></a>
                                            <a href="#"><button type="button" class="btn btn-danger">Excluir</button></a>
                                        </th>
                                        <th scope="row">{{$d->matricula}}</th>
                                        <td>{{$d->nomeDocente}}</td>
                                        <td>{{$d->cargo}}</td>
                                        <td><?php if($d->status == 1) echo "Ativo"; else echo "Inativo";?></td>
                                        <td>{{$d->pontosDeDesempenho}}</td>
                                        <td>{{$d->cargaHoraria}}</td>
                                        <td>{{$d->tempoDeServico}}</td>
                                    </tr>


                                @endforeach()

                            </tbody>

                        </table>

                        <a href="{{route('docente.create')}}"><button type="button" class="btn btn-success">Cadastrar</button></a>


                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
