@extends('layouts.layout')

@section('title', 'Home')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white">
                    <h2>PROFCTRL</h2>
                    <h4>Esta é a tela principal, onde você pode acessar todas as funcionalidades do sistema
                    </h4>
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-4">
                            <a class="btn btn-primary w-100" href="{{action('DocenteController@index')}}">Lista de docentes</a>
                        </div>
                        <div class="col-8 my-1">
                            <h5>- Exibe informações funcionais dos docentes</h5>
                        </div>
                        <div class="col-4">
                            <a class="btn btn-primary w-100"
                                href="{{action('ProgressaoController@index')}}">Dados profissionais</a>
                        </div>
                        <div class="col-8 my-1">
                            <h5>- Exibe informações referentes à carreira dos docentes</h5>
                        </div>
                        <div class="col-4">
                            <a class="btn btn-primary w-100"
                                href="{{action('EventoController@index')}}">Histórico de Eventos</a>
                        </div>
                        <div class="col-8 my-1">
                            <h5>- Exibe registro de todas alterações feitas no sistema</h5>
                        </div>
                        <div class="col-4">
                            <a class="btn btn-primary w-100"
                                href="{{action('LicencaController@index')}}">Licenças</a>
                        </div>
                        <div class="col-8 my-1">
                            <h5>- Exibe a lista das licenças cadastradas</h5>
                        </div>
                        <div class="col-4">
                            <a class="btn btn-primary w-100"
                                href="{{action('TituloController@index')}}">Títulos</a>
                        </div>
                        <div class="col-8 my-1">
                            <h5>- Exibe a lista dos títulos cadastrados</h5>
                        </div>
                        <div class="col-4">
                            <a class="btn btn-primary w-100"
                                href="{{action('RegraController@index')}}">Lei salarial vigente</a>
                        </div>
                        <div class="col-8 my-1">
                            <h5>- Define a alteração salarial de acordo com a lei vigente</h5>
                        </div>
                        <div class="col-4">
                            <a class="btn btn-primary w-100"
                                href="{{action('InformacoesController@index')}}">Informações gerais</a>
                        </div>
                        <div class="col-8 my-1">
                            <h5>- Exibe os dados do sistema</h5>
                        </div>
                        <div class="col-4">
                            <a class="btn btn-primary w-100"
                                href="{{action('ContatoController@index')}}">Contato</a>
                        </div>
                        <div class="col-8 my-1">
                            <h5>- Informações de contato dos desenvolvedores do sistema</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection