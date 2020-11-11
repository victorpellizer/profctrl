@extends('layouts.layout')

@section('title', 'Adicionar Titulo')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{action('DocenteController@index')}}">Docentes</a></li>
                    <li class="breadcrumb-item"><a href="{{action('DocenteController@show',$docente->idDocente)}}">Perfil - {{$docente->nomeDocente}}</a></li>
                    <li class="breadcrumb-item"><a href="{{action('TituloController@show',$docente->idDocente)}}">Títulos</a></li>
                    <li class="breadcrumb-item">Inserir título</li>
                    <!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
                </ol>
            </nav>

            @if(session('success'))


            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Titulo inserido com sucesso!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            @elseif(session('error'))

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Falha ao inserir título!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>

            @endif

            <div class="card">
                <div class="card-body"><h3>Inserir título novo de {{$docente->nomeDocente}}<i class="fa fa-info-circle btn btn-secundary" style="float: right" data-toggle="tooltip" data-placement="top" title="Para adicionar um novo título, insira um arquivo (Opcional) e preencha os campos corretamente e clique no botão 'Cadastrar Título."></i></h3>
                <hr>
<form method="POST" action="{{action('TituloController@store')}}" enctype="multipart/form-data">
@csrf
<h7>- Campos com '*' são obrigatórios.</h7>
<hr>
<input id="Docente_idDocente" type="hidden" name="Docente_idDocente" value="{{$docente->idDocente}}">
* Descrição do Título:
<input id="nomeTitulo" type="text" class="form-control @error('nomeTitulo') is-invalid @enderror" name="nomeTitulo" value="" required autocomplete="nomeTitulo" autofocus>
<br>

* Data do titulo:
                        <input id="dataTitulo" type="date"
                            class="form-control @error('dataTitulo') is-invalid @enderror" name="dataTitulo" value=""
                            required autofocus>
                        <br>
* Tipo do Título:
<select class="form-control @error('tipoTitulo') is-invalid @enderror" name="tipoTitulo" style="width: 200px">
	<option value="Graduação">Graduação</option>
	<option value="Mestrado">Mestrado</option>
	<option value="Doutorado">Doutorado</option>
	<option value="Pós-Graduação">Pós-Graduação</option>
	<option value="Palestra">Palestra</option>
	<option value="Workshop">Workshop</option>
	<option value="Outro">Outro</option>
</select>
<br>Anexo:<br>
<input type="file" name="arquivo">
<br>

<br>
Pontos de Desempenho:
<input id="pontosDeDesempenhoT" type="number" class="form-control @error('pontosDeDesempenhoT') is-invalid @enderror" name="pontosDeDesempenhoT" value="0" autocomplete="pontosDeDesempenhoT" style="width: 100px" autofocus min="0" max="99">
<br>
<button type="submit" class="btn btn-success">
    Cadastrar <i class="fa fa-save"></i>
</button>
 <a class="btn btn-info" href="{{action('TituloController@index')}}\{{$docente->idDocente}}">Voltar <i class="fa fa-arrow-left"></i></a>

</form>
        </div>
    </div>
</div>
</div>
</div>


@endsection