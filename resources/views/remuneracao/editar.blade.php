@extends('layouts.layout')

@section('title', 'Editar remuneração')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{action('DocenteController@index')}}">Docentes</a></li>
                    <li class="breadcrumb-item"><a
                            href="{{action('DocenteController@show',$docente->idDocente)}}">Perfil -
                            {{$docente->nomeDocente}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar remuneração</li>
                </ol>
            </nav>
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Remunerações atualizadas com Sucesso!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Falha ao atualizar Remunerações!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h3>Editar remuneração - {{$docente->nomeDocente}}</h3>
                    <form method="POST" action="{{action('RemuneracaoController@update',$docente->idDocente)}}">
                        @csrf
                        @method('PUT')
                        <table class="table display responsive no-wrap table-striped" style="width: 400px">
                            <tr>
                                <td>Classe</td>
                                <td>{{$docente->classe}}</td>
                            </tr>
                            <tr>
                                <td>Nível</td>
                                <td>{{$docente->nivel}}</td>
                            </tr>
                            <tr>
                                <td>Salário</td>
                                <th>{{$docente->beneficioS}}</th>
                            </tr>
                            <tr>
                                <td>Bonus por tempo de serviço</td>
                                <th>{{$docente->beneficioTS}}</th>
                            </tr>
                        </table>
                        <h5>Alteração de Benefícios</h5>
                        <hr>
                        <div class="col-md-6">
                            Gratificação (R$):
                            <select class="form-control @error('beneficioG') is-invalid @enderror" name="beneficioG"
                                style="width: 200px">
                                <option value="0" {{$docente->beneficioG==0 ? 'selected' : ''}}>0,00</option>
                                <option value="447.60" {{$docente->beneficioG==447.60 ? 'selected' : ''}}>447,60
                                </option>
                                <option value="453.43" {{$docente->beneficioG==453.43 ? 'selected' : ''}}>453,43
                                </option>
                                <option value="534.72" {{$docente->beneficioG==534.72 ? 'selected' : ''}}>534,72
                                </option>
                                <option value="630.97" {{$docente->beneficioG==630.97 ? 'selected' : ''}}>630,97
                                </option>
                                <option value="991.52" {{$docente->beneficioG==991.52 ? 'selected' : ''}}>991,52
                                </option>
                                <option value="1171.80" {{$docente->beneficioG==1171.80 ? 'selected' : ''}}>1171,80
                                </option>
                                <option value="1288.97" {{$docente->beneficioG==1288.97 ? 'selected' : ''}}>1288,97
                                </option>
                                <option value="1352.08" {{$docente->beneficioG==1352.08 ? 'selected' : ''}}>1352,08
                                </option>
                                <option value="1532.35" {{$docente->beneficioG==1532.35 ? 'selected' : ''}}>1532,35
                                </option>
                            </select>
                            <!--
    Gratificação (R$): <input id="beneficioG" style="width: 200px" type="number" class="form-control @error('beneficioG') is-invalid @enderror" name="beneficioG" value="{{$docente->beneficioG}}" required autocomplete="beneficioG" autofocus>
-->
                        </div>

                        <div class="col-md-6">
                            Deslocamento (R$):
                            <select class="form-control @error('beneficioD') is-invalid @enderror" name="beneficioD"
                                style="width: 200px">
                                <option value="0.00" {{$docente->beneficioD==0.00 ? 'selected' : ''}}>0,00</option>
                                <option value="191.83" {{$docente->beneficioD==191.83 ? 'selected' : ''}}>191,83
                                </option>
                            </select>
                            <!--
    <input id="beneficioD" style="width: 200px" type="number" class="form-control @error('beneficioD') is-invalid @enderror" name="beneficioD" value="{{$docente->beneficioD}}" required autocomplete="beneficioD" autofocus>
-->
                        </div>
                        <br>
                        <button type="submit" class="btn btn-success">Salvar <i class="fa fa-save"></i>
                        </button>
                        <a class="btn btn-info" href="{{action('DocenteController@show',$docente->idDocente)}}">Voltar
                            <i class="fa fa-arrow-left"></i></a>
                    </form>
                    <hr>
                    <h5>Histórico de alterações de remuneração</h5>
                    <table class="table display responsive no-wrap table-striped" style="width: 600px">
                        <thead>
                            <tr>
                                <th style="width: 100px">Tipo de Benefício</th>
                                <th style="width: 200px">Valor Benefício</th>
                                <th style="width: 400px">Editado por</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($remuneracoes as $r)
                            <tr>
                                <td>{{$r->tipoBeneficio}}</td>
                                <td>{{$r->valorBeneficio}}</td>
                                <td>{{$r->usuario}} em {{$r->dataInicioBeneficio}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection