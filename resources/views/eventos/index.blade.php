@extends('layouts.layout')

@section('title', 'Eventos')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="width: 100%">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Histórico de eventos</li>
                </ol>
            </nav>
            <div class="card">

                <div class="card-body">
                    <h3>Histórico de eventos</h3><br><br><br>
                    <table class="table display responsive no-wrap table-striped" style="width: 1000px">
                        <thead>
                            <tr>
                                <th>ID evento</th>
                                <th>Matrícula</th>
                                <th>Nome do docente</th>
                                <th>Alteração feita em</th>
                                <th>Novo Valor</th>
                                <th>Lei vigente</th>
                                <th>Criado por</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>1033</td>
                                <td>3278110</td>
                                <td>Victor Pellizer Iritsu</td>
                                <td>Classe</td>
                                <td>13</td>
                                <td>Lei 2132152132 de 2022</td>
                                <td>dev1 em 2020-10-06 00:20:44</td>
                            </tr>
                            <tr>
                                <td>1033</td>
                                <td>1111</td>
                                <td>Victor Iritsu</td>
                                <td>Nível</td>
                                <td>B</td>
                                <td>Lei 2132152132 de 2022</td>
                                <td>dev1 em 2020-10-06 00:25:33</td>
                            </tr>
                            <tr>
                                <td>1033</td>
                                <td>999</td>
                                <td>Victor Iritsu Pellizer</td>
                                <td>Lotação</td>
                                <td>Tônia Harms</td>
                                <td>Lei 2132152132 de 2022</td>
                                <td>dev1 em 2020-10-06 00:26:40</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection