@extends('layouts.layout')

@section('title', 'Adicionar licenca')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{action('DocenteController@index')}}">Docentes</a></li>
                    <li class="breadcrumb-item"><a href="{{action('DocenteController@show',$docente->idDocente)}}">Perfil - {{$docente->nomeDocente}}</a></li>
                    <li class="breadcrumb-item"><a href="{{action('LicencaController@show',$docente->idDocente)}}">Licenças</a></li>
                    <li class="breadcrumb-item">Inserir Licença</li>
                    <!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
                </ol>
            </nav>

            @if(session('success'))


            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Licença inserida com sucesso!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            @elseif(session('error'))

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Falha ao inserir licença!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>

            @endif



            <div class="card">
                <div class="card-body"><h3>Inserir nova licença de {{$docente->nomeDocente}} <i class="fa fa-info-circle btn btn-secundary" style="float: right" data-toggle="tooltip" data-placement="top" title="Para adicionar uma nova licença, insira um arquivo (Opcional) e preencha os campos corretamente e clique no botão 'Cadastrar Licença'."></i></h3>
                <hr>

<form method="POST" action="{{action('LicencaController@store')}}" enctype="multipart/form-data">
@csrf
<h7>- Campos com '*' são obrigatórios</h7>
<hr>
<input id="Docente_idDocente" type="hidden" name="Docente_idDocente" value="{{$docente->idDocente}}">
* Descrição da Licença:
<input id="nomeLicenca" type="text" class="form-control @error('nomeLicenca') is-invalid @enderror" name="nomeLicenca" value="" required autocomplete="nomeLicenca" autofocus>
<br>
* Tipo de Licença:
<select class="form-control @error('tipoTitulo') is-invalid @enderror" name="tipoLicenca" style="width: 300px">
    <option value="Qualificação Profissional">Qualificação Profissional</option>
    <option value="Sem Vencimento">Sem Vencimento</option>
    <option value="Prêmio">Prêmio</option>
</select>
<br>Anexo:<br>
<input type="file" name="arquivo">
<br>
<br>
<br>
<button type="submit" class="btn btn-success">
    Cadastrar Licença <i class="fa fa-save"></i>
</button>
<a class="btn btn-info" href="{{action('LicencaController@index')}}\{{$docente->idDocente}}">Voltar <i class="fa fa-arrow-left"></i></a>

</form>
        </div>
    </div>
</div>
</div>
</div>

@endsection