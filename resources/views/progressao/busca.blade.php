@extends('layouts.layout')

@section('title', 'Busca dados profissionais de docentes')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{action('HomeController@index')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="/progressao">Dados profissionais</a></li>
                    <li class="breadcrumb-item">Busca</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="row p-3">
                        <div class="col-6">
                            <h3><i class="fas fa-info-circle" title="Esta tela mostra o resultado da busca da tela de listagem de dados profissionais dos docentes."></i> Dados profissionais</h3>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <form action="{{url('/progressao/busca')}}" class="w-100" type="get">
                                <div class="row">
                                    <div class="col-9 text-right">
                                        <input name="query" type="search" class="form-control"
                                            placeholder="Buscar docente">
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-primary" type="submit">Buscar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <table class="table table-striped w-100">
                        <thead class="thead-dark">
                            <tr>
                                <th title="Nome completo do docente">
                                    Nome
                                </th>
                                <th title="Matrícula do docente">
                                    Matrícula
                                </th>
                                <th title="Nível do docente (A-D)">
                                    Nível
                                </th>
                                <th title="Classe do docente (1-15)">
                                    Classe
                                </th>
                                <th title="Instituição onde o docente está lotado">
                                    Lotação
                                </th>
                                <th title="Função do docente">
                                    Função
                                </th>
                                <th
                                    title="Remuneração do docente, composta por salário, tempo de serviço, gratificação e deslocamento">
                                    Remuneração
                                </th>
                            </tr>
                        </thead>
                        @if(isset($docentes))
                        <tbody>
                            @foreach($docentes as $item)
                            <tr>
                                <td><a href="/docentes/{{$item->idDocente}}">{{$item->nomeDocente}}</a></td>
                                <td>{{$item->matricula}}</td>
                                <td>{{$item->nivel}}</td>
                                <td>{{$item->classe}}</td>
                                <td>{{$item->lotacao}}</td>
                                <td>{{$item->funcao}}</td>
                                <td>R$ {{$item->beneficioTotal}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{$docentes->links()}}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection