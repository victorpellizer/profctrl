@extends('layouts.layout')

@section('title','Títulos do docente')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{action('DocenteController@index')}}">Docentes</a></li>
                    <li class="breadcrumb-item"><a href="{{action('DocenteController@show',$docente->idDocente)}}">Perfil</a></li>
                    <li class="breadcrumb-item">Títulos de {{$docente->nomeDocente}}</li>
                </ol>
            </nav>
			
			@if(session('success'))


            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Titulo removido com sucesso!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            @elseif(session('error'))

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Falha ao remover título!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>

            @endif
			
            <div class="card">
            <div class="card-body"><h3>Títulos de {{$docente->nomeDocente}} <i class="fa fa-info-circle btn btn-secundary" style="float: right" data-toggle="tooltip" data-placement="top" title="Aqui estão dispostos todos os títulos do docente {{$docente->nomeDocente}}. Você pode excluir os títulos ao clicar no ícone 'X' ao lado de cada título. Para mais informações sobre cada dado da tabela, posicionar o cursor do mouse sobre o dado."></i></h3>
                <table class="table display responsive no-wrap table-striped">
                	<thead>
                	<tr>

                		<th data-toggle="tooltip" data-placement="top" title="Descrição do título.">Descrição do título</th>
                		<th data-toggle="tooltip" data-placement="top" title="Tipo do título.">Tipo</th>
                        <th data-toggle="tooltip" data-placement="top" title="Anexo do título.">Anexo</th>
                		<th data-toggle="tooltip" data-placement="top" title="Pontos de Desempenho que o arquivo agrega.">Pontos de Desempenho</th>
                        <th data-toggle="tooltip" data-placement="top" title="Data que o título foi protocolado.">Data do título</th>
                		<th data-toggle="tooltip" data-placement="top" title="Data que o título foi anexado e o usuário que inseriu.">Inserido por</th>
                		<th style="text-align: center" data-toggle="tooltip" data-placement="top" title="Clique no 'X' para excluir o título.">Excluir</th>
                	</tr>
                	</thead>
                	<tbody>
                    @foreach($titulos as $t)
                		<td>{{$t->nomeTitulo}}</td>
                		<td>{{$t->tipoTitulo}}</td>
                        <td>
                            <div class="{{$t->nomeArquivo}}">
                                <a target="_blank" href="{{asset("storage/anexos_titulos/$t->nomeArquivo")}}">
                                    <img onerror="doSomething()" width="40" src="{{asset("storage/anexos_titulos/$t->nomeArquivo")}}">
                                </a>
                            </div>
                        </td>
                        <td>{{$t->pontosDeDesempenhoT}}</td>
                        <td>{{$t->dataTitulo}}</td>
                        <td>{{$t->usuario}} em {{$t->dataInsercao}}</td>
                		<td style="text-align: center">
                        <form method="POST" action="{{action('TituloController@destroy',$t->idTitulo)}}">
                        @csrf
                        @method('DELETE')
                            <button type="submit" onclick="return confirm('Tem certeza de que quer remover o título?')" class="btn btn-danger">
                                X
                            </button>
                        </form>
                        </td> 
                		</tbody>
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
                </table>
            <a href="{{action('TituloController@edit',$docente->idDocente)}}"><button type="button" class="btn btn-success">Inserir Título <i class="fa fa-graduation-cap"></i></button></a>
            <a class="btn btn-info" href="{{action('DocenteController@show',$docente->idDocente)}}">Voltar Para o Perfil <i class="fa fa-arrow-left"></i></a>
        </div>
    </div>
</div>
</div>
</div>

@endsection
