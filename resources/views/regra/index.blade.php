@extends('layouts.layout')

@section('title', 'Regra')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item">Lei de definição salarial</li>
                    <!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
                </ol>
                <div class="pt-2 pb-2">
                    <h3><i class="fas fa-info-circle" title="Esta tela apresenta todos os dados relacionados com a lei salarial vigente 
do município de Carambeí, para editar as informações, clique em Atualizar regra."></i> Lei vigente: {{$regra->descricao}}</h3>
                </div>
                <table class="table display responsive no-wrap table-striped" style="width: 600px">
                    <tr>
                        <th scope="col" style="width: 200px" data-toggle="tooltip" data-placement="top"
                            title="Salário base do docente">Salário base</th>
                        <td>R$ {{$regra->salarioBase}}</td>
                    </tr>
                    <tr>
                        <th data-toggle="tooltip" data-placement="top" title="Bônus por tempo de serviço">Bônus (%) por
                            Tempo de serviço</th>
                        <td>{{$regra->aumentoTDS}}% a cada 5 anos de Tempo de Serviço.</td>
                    </tr>
                    <tr>
                        <th data-toggle="tooltip" data-placement="top"
                            title="Aumento (em %) no salário por avanço de classe">Aumento (%) de salário por Classe
                        </th>
                        <td>{{$regra->aumentoClasse}}%</td>
                    </tr>
                    <tr>
                        <th data-toggle="tooltip" data-placement="top"
                            title="Aumento (em %) no salário por avançar do nível A para B">Aumento (%) de salário do
                            Nível A para B</th>
                        <td>{{$regra->aumentoNivelB}}%</td>
                    </tr>
                    <tr>
                        <th data-toggle="tooltip" data-placement="top"
                            title="Aumento (em %) no salário por avançar do nível B para C">Aumento (%) de salário do
                            Nível B para C</th>
                        <td>{{$regra->aumentoNivelC}}%</td>
                    </tr>
                    <tr>
                        <th data-toggle="tooltip" data-placement="top"
                            title="Aumento (em %) no salário por avançar do nível C para D">Aumento (%) de salário do
                            Nível C para D</th>
                        <td>{{$regra->aumentoNivelD}}%</td>
                    </tr>
                    <tr>
                        <th data-toggle="tooltip" data-placement="top"
                            title="Define a porcentagem do salário base que será o adicional por deslocamento">Adicional
                            de Deslocamento</th>
                        <td>{{$regra->deslocamento}}%, que equivale a R$ {{$regra->valorDeslocamento}}</td>
                    </tr>
                    <tr>
                        <th data-toggle="tooltip" data-placement="top"
                            title="Define a porcentagem do salário base que será a gratificação por exercício da função de direção em instituições de porte I">
                            Gratificação (%) para instituição Porte I</th>
                        <td>{{$regra->gratificacao1}}%, que equivale a R$ {{$regra->valorGratificacao1}}</td>
                    </tr>
                    <tr>
                        <th data-toggle="tooltip" data-placement="top"
                            title="Define a porcentagem do salário base que será a gratificação por exercício da função de direção em instituições de porte II">
                            Gratificação (%) para instituição Porte II</th>
                        <td>{{$regra->gratificacao2}}%, que equivale a R$ {{$regra->valorGratificacao2}}</td>
                    </tr>
                    <tr>
                        <th data-toggle="tooltip" data-placement="top"
                            title="Define a porcentagem do salário base que será a gratificação por exercício da função de direção em instituições de porte III">
                            Gratificação (%) para instituição Porte III</th>
                        <td>{{$regra->gratificacao3}}%, que equivale a R$ {{$regra->valorGratificacao3}}</td>
                    </tr>
                    <tr>
                        <th data-toggle="tooltip" data-placement="top"
                            title="Define a porcentagem do salário base que será a gratificação por exercício da função de direção em instituições de porte IV">
                            Gratificação (%) para instituição Porte IV</th>
                        <td>{{$regra->gratificacao4}}%, que equivale a R$ {{$regra->valorGratificacao4}}</td>
                    </tr>
                    <tr>
                        <th data-toggle="tooltip" data-placement="top"
                            title="Define a porcentagem do salário base que será a gratificação por exercício da função de direção em instituições de porte V">
                            Gratificação (%) para instituição Porte V</th>
                        <td>{{$regra->gratificacao5}}%, que equivale a R$ {{$regra->valorGratificacao5}}</td>
                    </tr>
                    <tr>
                        <th data-toggle="tooltip" data-placement="top" title="Regra atual foi inserida">Regra inserida
                            por</th>
                        <td>{{$regra->usuario}} em {{$regra->dataRegra}}</td>
                    </tr>
                </table>
                <a class="btn btn-warning border rounded" role="button"
                    href="{{action('RegraController@create')}}">Atualizar regra<i class="fa fa-edit"></i></a>
                <br>
                <div class="pt-3">
                <h5>Histórico de alterações de Regra</h5>
                <table class="table display responsive no-wrap table-striped" style="width: 600px">
                    <thead>
                        <tr>
                            <th style="width: 200px">Regra</th>
                            <th style="width: 400px">Editado por</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($regras as $r)
                        <tr>
                            <td>{{$r->nome}}</td>
                            <td>{{$r->usuario}} em {{$r->data}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                @endsection