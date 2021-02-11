@extends('layouts.layout')

@section('title', 'Editar perfil')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{action('DocenteController@index')}}">Docentes</a></li>
                    <li class="breadcrumb-item"><a
                            href="{{action('DocenteController@show',$docente->idDocente)}}">{{$docente->nomeDocente}}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Editar docente</li>
                </ol>
            </nav>
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Perfil de Docente atualizado com sucesso!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Não foi possível atualizar o perfil do docente. Tente novamente!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{action('DocenteController@update',$docente->idDocente)}}">
                        @csrf
                        @method('PUT')
                        <h3><i class="fas fa-info-circle" title="Nesta tela você pode editar os dados do perfil do docente, como o nome, 
matrícula, cargo, etc. Preencha os campos com os dados desejados e clique 
em Salvar para terminar a edição. Caso deseja voltar, clique em Voltar."></i> Editar docente - {{$docente->nomeDocente}}</h3>
                        <hr>
                        Nome:
                        <input id="nomeDocente" style="width: 500px" type="text"
                            class="form-control @error('nomeDocente') is-invalid @enderror" name="nomeDocente"
                            value="{{$docente->nomeDocente}}" required autocomplete="nomeDocente" autofocus>
                        @error('nomeDocente')
                        <span class="invalid-feedback" role="alert">
                            <strong>Nome inválido. Use somente letras de a-z e A-Z.</strong>
                        </span>
                        @enderror
                        Matrícula:
                        <input id="matricula" style="width: 200px" type="text"
                            class="form-control @error('matricula') is-invalid @enderror" name="matricula"
                            value="{{$docente->matricula}}" required autocomplete="matricula" autofocus>
                        @error('matricula')
                        <span class="invalid-feedback" role="alert">
                            <strong>Número de Matrícula inválido. A matrícula deve conter de 6 a 7 digitos.</strong>
                        </span>
                        @enderror
                        Cargo:
                        <select class="form-control @error('cargo') is-invalid @enderror" style="width: 200px"
                            name="cargo">
                            <option value="Professor" {{$docente->cargo=="Professor" ? 'selected' : ''}}>Professor
                            </option>
                            <option value="Professor Ed Infantil"
                                {{$docente->cargo=="Professor Ed Infantil" ? 'selected' : ''}}>Professor Ed Infantil
                            </option>
                        </select>

                        Carga horária:
                        <select class="form-control @error('cargaHoraria') is-invalid @enderror" style="width: 200px"
                            name="cargaHoraria">
                            <option value="20" {{$docente->cargaHoraria==20 ? 'selected' : ''}}>20</option>
                            <option value="40" {{$docente->cargaHoraria==40 ? 'selected' : ''}}>40</option>

                        </select>
                        Tempo de serviço (%):
                        <select class="form-control @error('tempoDeServico') is-invalid @enderror" name="tempoDeServico"
                            style="width: 200px">
                            <option value="0" {{$docente->tempoDeServico==0 ? 'selected' : ''}}>0</option>
                            <option value="5" {{$docente->tempoDeServico==5 ? 'selected' : ''}}>5</option>
                            <option value="10" {{$docente->tempoDeServico==10 ? 'selected' : ''}}>10</option>
                            <option value="15" {{$docente->tempoDeServico==15 ? 'selected' : ''}}>15</option>
                            <option value="20" {{$docente->tempoDeServico==20 ? 'selected' : ''}}>20</option>
                            <option value="25" {{$docente->tempoDeServico==25 ? 'selected' : ''}}>25</option>
                            <option value="30" {{$docente->tempoDeServico==30 ? 'selected' : ''}}>30</option>
                        </select>
                        <!--
    <input id="tempoDeServico"  style="width: 200px" type="text" class="form-control @error('tempoDeServico') is-invalid @enderror" name="tempoDeServico" value="{{$docente->tempoDeServico}}" required autocomplete="tempoDeServico" autofocus>
-->
                        Pontos de desempenho:
                        <input id="pontosDeDesempenho" style="width: 200px" type="text"
                            class="form-control @error('pontosDeDesempenho') is-invalid @enderror"
                            name="pontosDeDesempenho" value="{{$docente->pontosDeDesempenho}}" required
                            autocomplete="pontosDeDesempenho" autofocus>
                        @error('pontosDeDesempenho')
                        <span class="invalid-feedback" role="alert">
                            <strong>Número inválido. O número deve ser maior ou igual a 0 e menor ou igual a
                                99.</strong>
                        </span>
                        @enderror
                        <br>

                        <button type="submit" class="btn btn-success" onclick="Voltar()">Salvar <i
                                class="fa fa-save"></i>
                        </button>
                        <a class="btn btn-info" href="{{action('DocenteController@show',$docente->idDocente)}}">Voltar
                            <i class="fa fa-arrow-left"></i></a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection