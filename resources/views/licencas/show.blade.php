@extends('layouts.layout')

@section('title','Licenças do docente')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{action('DocenteController@index')}}">Docentes</a></li>
                    <li class="breadcrumb-item"><a href="{{action('DocenteController@show',$docente->idDocente)}}">Perfil - {{$docente->nomeDocente}}</a></li>
                    <li class="breadcrumb-item">Licenças de {{$docente->nomeDocente}}</li>
                </ol>
            </nav>

            @if(session('success'))


            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Licença removida com sucesso!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            @elseif(session('error'))

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Falha ao remover licença!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>

            @endif

            <div class="card">
            <div class="card-body"><h3>Licenças de {{$docente->nomeDocente}} <i class="fa fa-info-circle btn btn-secundary" style="float: right" data-toggle="tooltip" data-placement="top" title="Aqui estão dispostos todas as licenças do docente {{$docente->nomeDocente}}. Você pode excluir as licenças ao clicar no ícone 'X' ao lado de cada licença. Para mais informações sobre cada dado da tabela, posicionar o cursor do mouse sobre o dado."></i></h3>
                <table class="table display responsive no-wrap table-striped">
                	<thead>
                	<tr>
                		<th data-toggle="tooltip" data-placement="top" title="Descrição da licença.">Descrição da licença</th>
                		<th data-toggle="tooltip" data-placement="top" title="Tipo da licença.">Tipo</th>
                        <th data-toggle="tooltip" data-placement="top" title="Anexo da licença.">Anexo</th>
                        <th data-toggle="tooltip" data-placement="top" title="Data que a licença foi protocolada.">Data da licença</th>
                		<th data-toggle="tooltip" data-placement="top" title="Data que a licença foi anexada e o usuário que inseriu.">Inserido por</th>
                		<th data-toggle="tooltip" data-placement="top" title="Clique no 'X' para excluir a licença.">Excluir</th>
                        
                	</tr>
                	</thead>
                	<tbody>
                    @foreach($licencas as $l)
                		<td>{{$l->nomeLicenca}}</td>
                		<td>{{$l->tipoLicenca}}</td>
                        <td><a target="_blank" href="{{asset("storage/anexos_licencas/$l->nomeArquivo")}}"><img alt="Sem arquivo" width="40" src="{{asset("storage/anexos_licencas/$l->nomeArquivo")}}"></a></td></td>
                        <td>{{$l->dataLicenca}}</td>
                        <td>{{$l->usuario}} em {{$l->dataInsercao}}</td>
                        <td style="text-align: center">
                        <form method="POST" action="{{action('LicencaController@destroy',$l->idLicenca)}}">
                        @csrf
                        @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                X
                            </button>
                        </form>
                        </td> 
                		</tbody>
                    @endforeach
                </table>
            <a href="{{action('LicencaController@edit',$docente->idDocente)}}"><button type="button" class="btn btn-success">Inserir Licença <i class="fa fa-plus-square"></i></button></a>
            <a class="btn btn-info" href="{{action('DocenteController@show',$docente->idDocente)}}">Voltar Para o Perfil <i class="fa fa-arrow-left"></i></a>
        </div>
    </div>
</div>
</div>
</div>

@endsection
