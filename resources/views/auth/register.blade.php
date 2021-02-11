@extends('layouts.app')

@section('title', 'Cadastrar usuário')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                {{ __('Registrar novo usuário') }} <i class="fas fa-info-circle" title="Tela utilizada para registrar um novo usuário no sistema. Preencha os campos corretamente 
e obtenha um código de registro com um usuário ou desenvolvedor para permitir 
que seu cadastro seja efetuado, e assim que completar todos os campos, clique 
em Registrar usuário. Caso deseje voltar a tela de login, clique em Voltar.
Nessa tela você pode efetuar seu login, preenchendo os campos de e-mail e 
senha corretamente, podendo habilitar a função de lembrar o login e senha, 
para que em um próximo acesso, seja lembrado seu login. Depois de preenchidos os 
campos, clique em Login para efetuar o login. Também é possível acessar 
a tela de registro, clicando no botão Registrar-se."></i>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right" data-toggle="tooltip" data-placement="right" title="Nome completo do Usuário. Campos válidos: a-z, A-Z.">{{ __('Nome') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Nome inválido ou pode estar sendo usado por outro usuário. Use somente letras de a-z e A-Z. Tente novamente.</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right" data-toggle="tooltip" data-placement="right" title="Endereço de e-mail (Ex: exemplo@exemplo.com.">{{ __('Endereço de e-mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Este e-mail é inválido.</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right" data-toggle="tooltip" data-placement="right" title="Senha de login do usuário. Deve conter no mínimo 8 caracteres e deve ser igual ao campo de confirmação de senha.">{{ __('Senha') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Senha inválida. Digite corretamente a mesma senha para os 2 campos com no mínimo 8 caracteres.</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right" data-toggle="tooltip" data-placement="right" title="Confirmação de senha deve ser igual ao campo senha.">{{ __('Confirmar senha') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" data-toggle="tooltip" data-placement="right" title="Código do sistema para registrar novo Usuário.">{{ __('Código de registro') }}</label>
                            <div class="col-md-6">
                                <input type="password" name="confirmacao" class="form-control @error('confirmacao') is-invalid @enderror" style="width: 150px">
                                @error('confirmacao')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>O código é inválido.</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Registrar usuário') }} <i class="fa fa-user-o"></i>
                                </button>
                                <a class="btn btn-info" href="{{route('home')}}">Voltar <i class="fa fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
