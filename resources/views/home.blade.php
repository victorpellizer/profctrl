@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Bem vindo ao Profctrl</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <a href="{{action('DocenteController@index')}}"><button type="button" class="btn btn-info">Lista de Docentes</button></a>
                    <a href="{{action('ProgressaoController@index')}}"><button type="button" class="btn btn-info">Progressão de Carreira</button></a>
                    <img src="imagem/logo.jpeg" alt="Logo">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
