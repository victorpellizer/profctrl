@extends('layouts.layout')

@section('title', 'Editar função')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="width: 100%">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{action('DocenteController@index')}}">Docentes</a></li>
                    <li class="breadcrumb-item"><a
                            href="{{action('DocenteController@show',$docente->idDocente)}}">{{$docente->nomeDocente}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar função</li>
                </ol>
            </nav>
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Função atualizada com Sucesso!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Erro ao atualizar função!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h3>Editar função - {{$docente->nomeDocente}}</h3>
                    <hr>
                    <form method="POST" action="{{action('FuncaoController@update',$docente->idDocente)}}">
                        @csrf
                        @method('PUT')
                        <h5>Instituição</h5>
                        <select class="form-control @error('funcao') is-invalid @enderror" style="width: 200px"
                            name="funcao">
                            <option value="1" {{$docente->funcao=="Docência" ? 'selected' : ''}}>Docência</option>
                            <option value="2" {{$docente->funcao=="Docência no AEE" ? 'selected' : ''}}>Docência no AEE
                            </option>
                            <option value="3"
                                {{$docente->funcao=="Direção de instituição educacional" ? 'selected' : ''}}>Direção de
                                instituição educacional</option>
                            <option value="4"
                                {{$docente->funcao=="Direção aux de instituição educacional" ? 'selected' : ''}}>Direção
                                auxiliar de instituição educacional</option>
                            <option value="5" {{$docente->funcao=="Coordenação pedagógica" ? 'selected' : ''}}>
                                Coordenação pedagógica</option>
                            <option value="6" {{$docente->funcao=="Coordenação educacional" ? 'selected' : ''}}>
                                Coordenação educacional</option>
                        </select>
                        <br>
                        <button type="submit" class="btn btn-success">Salvar <i class="fa fa-save"></i>
                        </button>
                        <a class="btn btn-info" href="{{action('DocenteController@show',$docente->idDocente)}}">Voltar
                            <i class="fa fa-arrow-left"></i></a>
                        <hr>
                        <h5>Histórico de alterações na função:</h5>
                        <table class="table display responsive no-wrap table-striped" style="width: 600px">
                            <thead>
                                <tr>
                                    <th style="width: 400px">Função</th>
                                    <th style="width: 400px">Editado por</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($funcoes as $f)
                                <tr>
                                    <td>{{$f->nome}}</td>
                                    <td>{{$f->usuario}} em {{$f->data}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection