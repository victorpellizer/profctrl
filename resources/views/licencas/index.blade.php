
@extends('layouts.layout')

@section('title', 'Licenças')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item">Licenças</li>
                    <!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                <h3>
                <i class="fas fa-info-circle" title="Tela que indica todas as licenças dos docentes. Clique no nome do docente 
para acessar seu perfil, ou então clique na imagem respectiva na coluna 
anexo para visualizar em tela cheia o anexo."></i> Lista de licenças dos docentes
</h3>
                    <hr>
            <table class="table display responsive no-wrap table-striped">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col" data-toggle="tooltip" data-placement="top" title="Nome do Docente.">Nome do docente</th>
                    <th scope="col" data-toggle="tooltip" data-placement="top" title="Matrícula do Docente.">Matrícula</th>
                    <th scope="col" data-toggle="tooltip" data-placement="top" title="Tipo da Licença.">Tipo de licença</th>
                    <th scope="col" data-toggle="tooltip" data-placement="top" title="Descrição da Licença.">Descrição</th>
                    <th scope="col" data-toggle="tooltip" data-placement="top" title="Data da Licença.">Data da licença</th>
                    <th scope="col" data-toggle="tooltip" data-placement="top" title="Anexo da licença.">Anexo</th>
                    <th scope="col" data-toggle="tooltip" data-placement="top" title="Data de Inserção da Licença.">Inserido por</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($licencas as $l)
                    <tr>
                    <td><a href="{{action('LicencaController@show',$l->Docente_idDocente)}}">{{$l->nomeDocente}}</a></td>
                    <td>{{$l->matricula}}</a></td>
                    <td>{{$l->tipoLicenca}}</td>
                    <td>{{$l->nomeLicenca}}</td>
                    <td>{{$l->dataLicenca}}</td>
                    <td>
                        <div class="{{$l->nomeArquivo}}">
                            <a target="_blank" href="{{asset("storage/anexos_licencas/$l->nomeArquivo")}}">
                                <img onerror="doSomething()" width="40" src="{{asset("storage/anexos_licencas/$l->nomeArquivo")}}">
                            </a>
                        </div>
                    </td>
                    <td>{{$l->usuario}} em {{$l->dataInsercao}}</td>
                    </tr>
                @endforeach
                    <script>
                    var pai = document.getElementsByClassName('Sem arquivo');
                    var i;
                    function doSomething(){
                        for(i = 0; i < pai.length; i++) {
                            pai[i].style.display = "none";
                        }
                    }
                    </script>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div></div>
@endsection