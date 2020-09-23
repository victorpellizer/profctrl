@extends('layouts.layout')

@section('title', 'Home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="container-fluid">
            <div class="card d-sm-flex justify-content-between">
                <div class="card-header"><h3>Bem vindo ao Sistema Profctrl</h3><h2><i class="fa fa-info-circle btn btn-secundary" style="float: right" data-toggle="tooltip" data-placement="top" title="Esta é a tela principal, nela você pode encontrar todas as funções do sistema."></i></h2></div>
                
                </div>
                <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-xl-2 offset-xl-0 mx-auto" style="max-width: 16%; flex: 16%"><a class="btn btn-primary border rounded" role="button" href="{{action('RegraController@index')}}" style="width: 150px">Lei Salarial Vigente</a>
                        </div>
                        <div class="col">
                            <h5 style="padding-left: 50px">- Define a alteração salarial de acordo com a lei vigente</h5>
                        </div>
    
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xl-2 offset-xl-0 mx-auto" style="max-width: 16%; flex: 16%"><a class="btn btn-primary border rounded" role="button" href="{{action('DocenteController@index')}}" style="width: 150px">Lista de Docentes</a>
                        </div>
                        <div class="col">
                            <h5 style="padding-left: 50px">- Exibe informações funcionais dos Docentes</h5>
                        </div>
                        <a href="{{action('DocenteController@create')}}"><button type="button" class="btn btn-success">Cadastrar Novo Docente <i class="fa fa-user-o"></i></button></a>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xl-2 offset-xl-0"><a class="btn btn-primary border rounded" role="button" href="{{action('ProgressaoController@index')}}" style="width: 150px">Progressão de Carreira</a></div>
                        <div class="col">
                            <h5 style="padding-left: 50px">- Exibe informações referentes à carreira dos Docentes</h5>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xl-2 offset-xl-0"><a class="btn btn-primary border rounded" role="button" href="{{action('LicencaController@index')}}" style="width: 150px">Licenças</a></div>
                        <div class="col">
                            <h5 style="padding-left: 50px">- Exibe a lista das Licenças cadastradas</h5>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xl-2 offset-xl-0"><a class="btn btn-primary border rounded" role="button" href="{{action('TituloController@index')}}" style="width: 150px">Títulos</a></div>
                        <div class="col">
                            <h5 style="padding-left: 50px">- Exibe a lista dos Títulos cadastrados</h5>
                        </div>
                    </div>
<hr>
                    <div class="row">
                        <div class="col-xl-2 offset-xl-0"><a class="btn btn-primary border rounded"  role="button" href="{{action('InformacoesController@index')}}" style="width: 150px">Informações Gerais</a></div>
                        <div class="col">
                            <h5 style="padding-left: 50px">- Exibe os dados do sistema.</h5>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
