@extends('layouts.layout')

@section('title', 'Títulos')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item">Títulos</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <h3><i class="fas fa-info-circle" title="Tela que indica todos os títulos dos docentes. Clique no nome do docente para 
acessar seu perfil, ou então clique na imagem respectiva na coluna anexo para 
visualizar em tela cheia o anexo."></i> Lista de títulos dos docentes
                    </h3>
                    <hr>
                    <table class="table display responsive no-wrap table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th title="Nome completo do Docente.">Nome do docente</th>
                                <th title="Matrícula do Docente.">Matrícula</th>
                                <th title="Tipo do título.">Tipo de título</th>
                                <th title="Descrição do título.">Descrição</th>
                                <th title="Pontos de desempenho do título.">Pontos de desempenho</th>
                                <th title="Data de validez do título.">Data do título</th>
                                <th title="Anexo do título.">Anexo</th>
                                <th title="Data de inserção do título.">Inserido por</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($titulos as $t)
                            <tr>
                                <td><a
                                        href="{{action('TituloController@show',$t->Docente_idDocente)}}">{{$t->nomeDocente}}</a>
                                </td>
                                <td>{{$t->matricula}}</td>
                                <td>{{$t->tipoTitulo}}</td>
                                <td>{{$t->nomeTitulo}}</td>
                                <td>{{$t->pontosDeDesempenhoT}}</td>
                                <td>{{$t->dataTitulo}}</td>
                                <td>
                                    <div class="{{$t->nomeArquivo}}">
                                        <a target="_blank" href="{{ url("storage/anexos_titulos/{$t->nomeArquivo}") }}">
                                            <img onerror="doSomething()" width="40"
                                                src="{{asset("storage/anexos_titulos/$t->nomeArquivo")}}">
                                        </a>
                                    </div>
                                </td>
                                <td>{{$t->usuario}} em {{$t->dataInsercao}}</td>
                            </tr>
                            @endforeach
                            <script>
                            var pai = document.getElementsByClassName('Sem arquivo');
                            var i;

                            function doSomething() {
                                for (i = 0; i < pai.length; i++) {
                                    pai[i].style.display = "none";
                                }
                            }
                            </script>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection