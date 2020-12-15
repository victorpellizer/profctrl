@extends('layouts.layout')

@section('title', 'Perfil docente')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="width: 100%">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{action('DocenteController@index')}}">Docentes</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Perfil docente - {{$docente->nomeDocente}}
                    </li>
                </ol>
            </nav>

            @if(session('success') && $docente->status == 'Inativo')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Docente Inativado com Sucesso! Seus benefícios e lotação foram anulados!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Não foi possível Ativado o Docente!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            @if(session('success') && $docente->status == 'Ativo')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Docente Ativado com Sucesso! Não esqueça de colocar novamente os benefícios e a lotação!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h3>Perfil de docente - {{$docente->nomeDocente}} <i class="fa fa-info-circle btn btn-secundary"
                            style="float: right" data-toggle="tooltip" data-placement="top" title="Aqui estão as informações cadastrais do docente  {{$docente->nomeDocente}}, 
                            você pode clicar no botão de visualização de títulos e licenças, assim como, também 
                            pode editar o perfil dele ou clicar nos ícones de edição de progressão de carreira 
                            para mudar dados sobre a Progressão de Carreira do Docente. Para mais informações 
                            sobre cada dado da tabela, posicionar o cursor do mouse sobre o dado."></i>
                    </h3>
                    <hr>

                    <table class="table display responsive no-wrap table-striped" style="width: 600px">
                        <tr>
                            <th scope="col" style="width: 200px" data-toggle="tooltip" data-placement="top"
                                title="Nome completo do Docente.">Docente</th>
                            <td>{{$docente->nomeDocente}}</td>
                        </tr>
                        <tr>
                            <th data-toggle="tooltip" data-placement="top"
                                title="Número de matricula do Docente de 6 a 7 números">Matrícula</th>
                            <td>{{$docente->matricula}}</td>
                        </tr>
                        <tr>
                            <th data-toggle="tooltip" data-placement="top" title="Cargo do Docente.">Cargo</th>
                            <td>{{$docente->cargo}}</td>
                        </tr>
                        <tr>
                            <th data-toggle="tooltip" data-placement="top" title="Carga Horária do Docente.">Carga
                                horária</th>
                            <td>{{$docente->cargaHoraria}}</td>
                        </tr>
                        <tr>
                            <th data-toggle="tooltip" data-placement="top"
                                title="Bônus de Tempo de Serviço do Docente em Porcentagem.">Tempo de serviço (%)</th>
                            <td>{{$docente->tempoDeServico}}%</td>
                        </tr>
                        <tr>
                            <th data-toggle="tooltip" data-placement="top"
                                title="Pontos de Desempenhos acumulados pelo Docente sendo maior ou igual a 0 e menor ou igual a 99.">
                                Pontos de Desempenho</th>
                            <td>{{$docente->pontosDeDesempenho}}</td>
                        </tr>
                        <tr>
                            <th data-toggle="tooltip" data-placement="top" title="Status do Docente.">Status</th>
                            <td class="text-primary">{{$docente->status}}</td>
                        </tr>
                        <tr>
                            <th data-toggle="tooltip" data-placement="top" title="Anexos do Docente.">Anexos</th>
                            <td><a href="{{action('TituloController@index')}}/{{$docente->idDocente}}"
                                    class="btn btn-outline-info"> Títulos <i class="fa fa-graduation-cap"></i></a>
                                <a href="{{action('LicencaController@index')}}/{{$docente->idDocente}}"
                                    class="btn btn-outline-info"> Licenças <i class="fa fa-plus-square"></i></a>
                            </td>
                        </tr>
                    </table>
                    <div class="row pb-3 pl-3">
                        <a class="btn btn-warning border rounded" role="button"
                            href="{{action('DocenteController@edit',$docente->idDocente)}}">Editar Docente <i
                                class="fa fa-edit"></i></a>
                        @if($docente->status == 'Inativo')
                        <form method="POST" action="{{action('DocenteController@destroy',$docente->idDocente)}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-success border rounded">Ativar Docente <i
                                    class="fa fa-power-off"></i></button>
                        </form>
                        @elseif($docente->status == 'Ativo')
                        <form method="POST" action="{{action('DocenteController@destroy',$docente->idDocente)}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger border rounded">Inativar Docente <i
                                    class="fa fa-power-off"></i></button>
                        </form>
                        @endif
                    </div>
                    <h3>Progressão de Carreira do Docente</h3>
                    <hr>
                    <table class="table display responsive no-wrap table-striped" style="width: 600px">
                        <tr>
                            <th scope="col" style="width: 200px" data-toggle="tooltip" data-placement="top"
                                title="Instituição em que o Docente está Lotado.">Lotação</th>
                            <td>{{$docente->lotacao}}</td>
                            <td scope="col" style="width: 20px"><a
                                    href="{{action('LotacaoController@edit',$docente->idDocente)}}"><i
                                        class="fa fa-edit"></i></a></td>
                        </tr>
                        <tr>
                            <th data-toggle="tooltip" data-placement="top" title="Função exercida pelo Docente.">Função
                            </th>
                            <td>{{$docente->funcao}}</td>
                            <td><a href="{{action('FuncaoController@edit',$docente->idDocente)}}"><i
                                        class="fa fa-edit"></i></a></td>
                        </tr>
                        <tr>
                            <th data-toggle="tooltip" data-placement="top" title="Classe atual do Docente.">Classe</th>
                            <td>{{$docente->classe}}</td>
                            <td><a href="{{action('ClasseController@edit',$docente->idDocente)}}"><i
                                        class="fa fa-edit"></i></a></td>
                        </tr>
                        <tr>
                            <th data-toggle="tooltip" data-placement="top" title="Nível atual do Docente.">Nível</th>
                            <td>{{$docente->nivel}}</td>
                            <td><a href="{{action('NivelController@edit',$docente->idDocente)}}"><i
                                        class="fa fa-edit"></i></a></td>
                        </tr>
                        <tr>
                            <th data-toggle="tooltip" data-placement="top"
                                title="Soma de todas as remunerações atuais do Docente (R$).">Remuneração Total</th>
                            <td>{{$docente->beneficioTotal}}</td>
                            <td><a href="{{action('RemuneracaoController@edit',$docente->idDocente)}}"><i
                                        class="fa fa-edit"></i></a></td>
                        </tr>
                        <tr>
                            <th data-toggle="tooltip" data-placement="top"
                                title="Benefício de Salário do Docente (R$).">Salário</th>
                            <td>{{$docente->beneficioS}}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <th data-toggle="tooltip" data-placement="top"
                                title="Benefício de Tempo de Serviço do Docente (R$).">Bônus por Tempo de Serviço</th>
                            <td>{{$docente->beneficioTS}}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <th data-toggle="tooltip" data-placement="top"
                                title="Benefício de Deslocamento do Docente (R$).">Deslocamento</th>
                            <td>{{$docente->beneficioD}}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <th data-toggle="tooltip" data-placement="top"
                                title="Benefício de Gratificação do Docente (R$).">Gratificação</th>
                            <td>{{$docente->beneficioG}}</td>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection