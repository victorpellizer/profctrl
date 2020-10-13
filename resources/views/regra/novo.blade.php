@extends('layouts.layout')

@section('title', 'Nova Regra')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{action('RegraController@index')}}">Lei de definição salarial</a></li>
                    <li class="breadcrumb-item">Nova regra</li>
                </ol>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Cadastro de Nova Regra efetuado com sucesso!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Não foi possível cadastrar a Nova Regra. Tente novamente!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                @endif


                <div class="card">
                <div class="card-header">Cadastro de Nova Regra</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h6>- Todos os Campos são OBRIGATÓRIOS.</h6><br>
                    <h6>- Para mais informações, mantenha o cursor do mouse sobre o dado a ser inserido.</h6><br>
                    <form method="POST" action="{{action('RegraController@store')}}">
                        @csrf

                        <div class="form-group row">
                            <label for="salarioBase" class="col-md-4 col-form-label text-md-right" data-toggle="tooltip" data-placement="right" title="O salário base do docente deve conter somente números e ser positivo.">Salário base:</label>

                            <div class="col-md-6">
                                <input id="salarioBase" type="text" class="form-control @error('salarioBase') is-invalid @enderror" name="salarioBase" value="" required autocomplete="salarioBase" autofocus placeholder="Salário base">

                                @error('salarioBase')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Salário inválido. Tente novamente digitando somente números não negativos.</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="aumentoTDS" class="col-md-4 col-form-label text-md-right" data-toggle="tooltip" data-placement="right" title="O bônus deve conter somente números e ser positivo.">Bônus (%) por Tempo de serviço:</label>

                            <div class="col-md-6">
                                <input id="aumentoTDS" type="text" class="form-control @error('aumentoTDS') is-invalid @enderror" name="aumentoTDS" value="" required autocomplete="aumentoTDS" autofocus placeholder="Bônus por Tempo de serviço">

                                @error('aumentoTDS')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Bônus inválido. Tente novamente digitando somente números não negativos.</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="aumentoClasse" class="col-md-4 col-form-label text-md-right" data-toggle="tooltip" data-placement="right" title="O aumento (em %) no salário por avanço de classe deve conter somente números e ser positivo.">Aumento (%) de salário por Classe:</label>

                            <div class="col-md-6">
                                <input id="aumentoClasse" type="text" class="form-control @error('aumentoClasse') is-invalid @enderror" name="aumentoClasse" value="" required autocomplete="aumentoClasse" autofocus placeholder="Aumento de salário por Classe">

                                @error('aumentoClasse')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Aumento inválido. Tente novamente digitando somente números não negativos.</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="aumentoNivelB" class="col-md-4 col-form-label text-md-right" data-toggle="tooltip" data-placement="right" title="O aumento (em %) no salário por avançar do nível A para B deve conter somente números e ser positivo.">Aumento (%) de salário do Nível A para B:</label>

                            <div class="col-md-6">
                                <input id="aumentoNivelB" type="text" class="form-control @error('aumentoNivelB') is-invalid @enderror" name="aumentoNivelB" value="" required autocomplete="aumentoNivelB" autofocus placeholder="Aumento de salário do Nível A para B">

                                @error('aumentoNivelB')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Aumento inválido. Tente novamente digitando somente números não negativos.</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="aumentoNivelC" class="col-md-4 col-form-label text-md-right" data-toggle="tooltip" data-placement="right" title="O aumento (em %) no salário por avançar do nível B para C deve conter somente números e ser positivo.">Aumento (%) de salário do Nível B para C:</label>

                            <div class="col-md-6">
                                <input id="aumentoNivelC" type="text" class="form-control @error('aumentoNivelC') is-invalid @enderror" name="aumentoNivelC" value="" required autocomplete="aumentoNivelC" autofocus placeholder="Aumento de salário do Nível B para C">

                                @error('aumentoNivelC')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Aumento inválido. Tente novamente digitando somente números não negativos.</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="aumentoNivelD" class="col-md-4 col-form-label text-md-right" data-toggle="tooltip" data-placement="right" title="O aumento (em %) no salário por avançar do nível C para D deve conter somente números e ser positivo.">Aumento (%) de salário do Nível C para D:</label>

                            <div class="col-md-6">
                                <input id="aumentoNivelD" type="text" class="form-control @error('aumentoNivelD') is-invalid @enderror" name="aumentoNivelD" value="" required autocomplete="aumentoNivelD" autofocus placeholder="Aumento de salário do Nível C para D">

                                @error('aumentoNivelD')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Aumento inválido. Tente novamente digitando somente números não negativos.</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="deslocamento" class="col-md-4 col-form-label text-md-right" data-toggle="tooltip" data-placement="right" title="Define a porcentagem do salário base que será o adicional por deslocamento, e deve conter somente números e ser positivo.">Adicional de Deslocamento:</label>

                            <div class="col-md-6">
                                <input id="deslocamento" type="text" class="form-control @error('deslocamento') is-invalid @enderror" name="deslocamento" value="" required autocomplete="deslocamento" autofocus placeholder="Deslocamento">

                                @error('deslocamento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Adicional inválido. Tente novamente digitando somente números não negativos.</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gratificacao1" class="col-md-4 col-form-label text-md-right" data-toggle="tooltip" data-placement="right" title="Define a porcentagem do salário base que será a gratificação por exercício da função de direção em instituições de porte I, e deve conter somente números e ser positivo.">Gratificação (%) para instituição Porte I:</label>

                            <div class="col-md-6">
                                <input id="gratificacao1" type="text" class="form-control @error('gratificacao1') is-invalid @enderror" name="gratificacao1" value="" required autocomplete="gratificacao1" autofocus placeholder="Gratificação para instituição Porte I">

                                @error('gratificacao1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Adicional inválido. Tente novamente digitando somente números não negativos.</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gratificacao2" class="col-md-4 col-form-label text-md-right" data-toggle="tooltip" data-placement="right" title="Define a porcentagem do salário base que será a gratificação por exercício da função de direção em instituições de porte II, e deve conter somente números e ser positivo.">Gratificação (%) para instituição Porte II:</label>

                            <div class="col-md-6">
                                <input id="gratificacao2" type="text" class="form-control @error('gratificacao2') is-invalid @enderror" name="gratificacao2" value="" required autocomplete="gratificacao2" autofocus placeholder="Gratificação para instituição Porte II">

                                @error('gratificacao2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Adicional inválido. Tente novamente digitando somente números não negativos.</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gratificacao3" class="col-md-4 col-form-label text-md-right" data-toggle="tooltip" data-placement="right" title="Define a porcentagem do salário base que será a gratificação por exercício da função de direção em instituições de porte III, e deve conter somente números e ser positivo.">Gratificação (%) para instituição Porte III:</label>

                            <div class="col-md-6">
                                <input id="gratificacao3" type="text" class="form-control @error('gratificacao3') is-invalid @enderror" name="gratificacao3" value="" required autocomplete="gratificacao3" autofocus placeholder="Gratificação para instituição Porte III">

                                @error('gratificacao3')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Adicional inválido. Tente novamente digitando somente números não negativos.</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gratificacao4" class="col-md-4 col-form-label text-md-right" data-toggle="tooltip" data-placement="right" title="Define a porcentagem do salário base que será a gratificação por exercício da função de direção em instituições de porte IV, e deve conter somente números e ser positivo.">Gratificação (%) para instituição Porte IV:</label>

                            <div class="col-md-6">
                                <input id="gratificacao4" type="text" class="form-control @error('gratificacao4') is-invalid @enderror" name="gratificacao4" value="" required autocomplete="gratificacao4" autofocus placeholder="Gratificação para instituição Porte IV">

                                @error('gratificacao4')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Adicional inválido. Tente novamente digitando somente números não negativos.</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gratificacao5" class="col-md-4 col-form-label text-md-right" data-toggle="tooltip" data-placement="right" title="Define a porcentagem do salário base que será a gratificação por exercício da função de direção em instituições de porte V, e deve conter somente números e ser positivo.">Gratificação (%) para instituição Porte V:</label>

                            <div class="col-md-6">
                                <input id="gratificacao5" type="text" class="form-control @error('gratificacao5') is-invalid @enderror" name="gratificacao5" value="" required autocomplete="gratificacao5" autofocus placeholder="Gratificação para instituição Porte V">

                                @error('gratificacao5')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Adicional inválido. Tente novamente digitando somente números não negativos.</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                     Cadastrar <i class="fa fa-save"></i>
                                </button>
                                <a class="btn btn-info" href="{{action('RegraController@index')}}">Voltar <i class="fa fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </form>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection