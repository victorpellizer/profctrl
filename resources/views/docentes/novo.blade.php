@extends('layouts.layout')

@section('title','Cadastro de docente')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{action('DocenteController@index')}}">Docentes</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cadastro</li>
                </ol>
            </nav>
			
			@if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Cadastro de Docente efetuado com sucesso!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Não foi possível cadastrar o Docente. Tente novamente!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            @endif

            <div class="card">
                <div class="card-header">Cadastro de Docente</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h6>- Todos os Campos são OBRIGATÓRIOS.</h6><br>
                    <h6>- Para mais informações, mantenha o cursor do mouse sobre o dado a ser inserido.</h6><br>
                    <form method="POST" action="{{action('DocenteController@store')}}">
                        @csrf


                        <div class="form-group row">
                            <label for="nomeDocente" class="col-md-4 col-form-label text-md-right" data-toggle="tooltip" data-placement="right" title="Nome do Docente. O nome deve conter somente letras de a-z e A-Z.">Nome:</label>

                            <div class="col-md-6">
                                <input id="nomeDocente" type="text" class="form-control @error('nomeDocente') is-invalid @enderror" name="nomeDocente" value="" required autocomplete="nomeDocente" autofocus placeholder="Nome Completo">

                                @error('nomeDocente')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Nome inválido. Tente novamente digitando apenas letras de a-z e A-Z.</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right" data-toggle="tooltip" data-placement="right" title="Número de matricula do Docente de 6 a 7 digitos.">Matrícula:</label>

                            <div class="col-md-2">
                                <input id="field" type="number" class="form-control @error('matricula') is-invalid @enderror" name="matricula" value="{{ old('matricula') }}" autofocus placeholder="0000000">

                                @error('matricula')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Número de Matrícula inválido. A matrícula deve conter de 6 a 7 digitos.</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right" data-toggle="tooltip" data-placement="right" title="Quantidade de Pontos de Desempenho do Docente (Menor que 100)">Pontos de Desempenho:</label>

                            <div class="col-md-2">
                                <input id="pontosDeDesempenho" type="number" class="form-control @error('pontosDeDesempenho') is-invalid @enderror" name="pontosDeDesempenho" value="{{ old('pontosDeDesempenho') }}" autofocus placeholder="0">

                                @error('pontosDeDesempenho')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Campo inválido, digite novamente. Somente números entre 1~99.</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cargo" class="col-md-4 col-form-label text-md-right" data-toggle="tooltip" data-placement="right" title="Cargo que o Docente ocupa.">Cargo:</label>

                            <div class="col-md-6">
                                <select class="form-control @error('cargo') is-invalid @enderror"  style="width: 200px" name="cargo" >
                                    <option value="Professor">Professor</option>
                                    <option value="Professor Ed Infantil" >Professor Ed Infantil</option>
                                </select>

                                @error('cargo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="funcao" class="col-md-4 col-form-label text-md-right" data-toggle="tooltip" data-placement="right" title="Função que o Docente exerce.">Função:</label>

                            <div class="col-md-6">
                                <select class="form-control @error('funcao') is-invalid @enderror"  style="width: 200px" name="funcao" >
        <option value="1" >Docência</option>
        <option value="2" >Docência no AEE</option>
        <option value="3" >Direção de instituição educacional</option>
        <option value="4" >Direção auxiliar de instituição educacional</option>
        <option value="5" >Coordenação pedagógica</option>
        <option value="6" >Coordenação educacional</option>
    </select>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lotacao" class="col-md-4 col-form-label text-md-right" data-toggle="tooltip" data-placement="right" title="Instituição em que o Docente está lotado.">Lotação:</label>

                            <div class="col-md-6">
                                <select class="form-control @error('lotacao') is-invalid @enderror"  style="width: 200px" name="lotacao" >
								<option value="15">Sem Lotação</option>
        <option value="1" >Betânia</option>
        <option value="2" >Tônia Harms</option>
        <option value="3" >Geralda Harms</option>
        <option value="4">Fátima A. Bosa</option>
        <option value="5" >Canaã</option>
        <option value="6" >Limpo Grande</option>
        <option value="7" >São Judas Tadeu</option>
        <option value="8" >José P. N. Rosas</option>
        <option value="9" >SMEC</option>
        <option value="10" >Sta Rita de Cassia</option>
        <option value="11" >Theresa G. Seifarth</option>
        <option value="12" >Santa Cruz</option>
        <option value="13" >Dep. Alim. Esc</option>
        <option value="14" >Biblioteca</option>      

    </select>

                              
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nivel" class="col-md-4 col-form-label text-md-right" data-toggle="tooltip" data-placement="right" title="Nível do Docente (Elevação vertical).">Nivel:</label>

                            <div class="col-md-6">
                                <select class="form-control @error('nivel') is-invalid @enderror" style="width: 80px" name="nivel">
            <option value="1" >A</option>
            <option value="2" >B</option>
            <option value="3" >C</option>
            <option value="4" >D</option>
        </select>

                               
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="classe" class="col-md-4 col-form-label text-md-right" data-toggle="tooltip" data-placement="right" title="Classe do Docente (Elevação Horizontal).">Classe:</label>

                            <div class="col-md-2">
                                <select id="classe" class="form-control @error('classe') is-invalid @enderror" style="width: 80px" name="classe">
            <option value="1" >1</option>
            <option value="2" >2</option>
            <option value="3" >3</option>
            <option value="4" >4</option>
            <option value="5" >5</option>
            <option value="6" >6</option>
            <option value="7" >7</option>
            <option value="8" >8</option>
            <option value="9" >9</option>
            <option value="10" >10</option>
            <option value="11" >11</option>
            <option value="12" >12</option>
            <option value="13" >13</option>
            <option value="14" >14</option>
            <option value="15" >15</option>
        </select>

                             
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cargaHoraria" class="col-md-4 col-form-label text-md-right" data-toggle="tooltip" data-placement="right" title="Carga Horaria do cargo do Docente em horas semanais.">Carga Horaria:</label>

                            <div class="col-md-2">
                                <select class="form-control @error('cargaHoraria') is-invalid @enderror"  style="width: 200px" name="cargaHoraria" >
        <option value="20" >20</option>
        <option value="40" >40</option>
        
    </select>

                               
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tempoDeServico" class="col-md-4 col-form-label text-md-right" data-toggle="tooltip" data-placement="right" title="Benefício de Tempo de Serviço em porcentagem (%).">Tempo De Servico (%):</label>

                            <div class="col-md-2">
                                <select class="form-control @error('tempoDeServico') is-invalid @enderror" name="tempoDeServico" style="width: 200px">
                                    <option value="0">0</option>
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                    <option value="30">30</option>
                                </select>
                                <!--
                                <input id="tempoDeServico" type="number" class="form-control @error('tempoDeServico') is-invalid @enderror" name="tempoDeServico" value="" required autocomplete="tempoDeServico" autofocus>
-->
                            
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="valorGratificacao" class="col-md-4 col-form-label text-md-right" data-toggle="tooltip" data-placement="right" title="Benefício de Gratificação em Reais (R$).">Gratificação (R$):</label>

                            <div class="col-md-2">
                                <select class="form-control @error('beneficioG') is-invalid @enderror" name="beneficioG" style="width: 200px">
            <option value="0.00">0,00</option>
            <option value="447.60">447,60</option>
            <option value="453.43">453,43</option>
            <option value="534.72">534,72</option>
            <option value="630.97">630,97</option>
            <option value="991.52">991,52</option>
            <option value="1171.80">1171,80</option>
            <option value="1288.97">1288,97</option>
            <option value="1352.08">1352,08</option>
            <option value="1532.35">1532,35</option>
        </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="valorDeslocamento" class="col-md-4 col-form-label text-md-right" data-toggle="tooltip" data-placement="right" title="Benefício de Deslocamento em Reais (R$).">Deslocamento (R$):</label>

                            <div class="col-md-2">
                            <select class="form-control @error('beneficioD') is-invalid @enderror" name="beneficioD">
                                <option value="0.00">0,00</option>
                                <option value="191.83">191,83</option>
                            </select>
                            <!--
                                <input id="valorDeslocamento" type="number" class="form-control @error('valorDeslocamento') is-invalid @enderror" name="valorDeslocamento" value="" required autocomplete="valorDeslocamento" autofocus>
-->
                          
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                     Cadastrar <i class="fa fa-save"></i>
                                </button>
                                <a class="btn btn-info" href="{{action('DocenteController@index')}}">Voltar <i class="fa fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </form>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
