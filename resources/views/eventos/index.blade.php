@extends('layouts.layout')

@section('title', 'Eventos')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item">Eventos</li>
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
                            <div class="row">
                                <div class="col-12">
                                    <h3><i class="fas fa-info-circle" title="Tela para visualização do histórico de eventos do sistema, onde pode-se verificar 
o identificador do evento, juntamente com a mudança feita, por quem foi feito e 
a data e horário que foi feito."></i> Eventos</h3>
                                </div>
                                <div class="col-12">
                                    <form action="{{url('/eventos/filtro')}}" class="w-100" type="get">
                                        <div class="row">
                                            <div class="col-3">
                                                <h3>Período:</h3>
                                            </div>
                                            <div class="col-3">
                                                <select id="eventoAno"
                                                    class="form-control @error('eventoAno') is-invalid @enderror"
                                                    name="ano">
                                                    <option value="2020">2020</option>
                                                    <option value="2021">2021</option>
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <select id="eventoMes"
                                                    class="form-control @error('eventoMes') is-invalid @enderror"
                                                    name="mes">
                                                    <option value="1">janeiro</option>
                                                    <option value="2">fevereiro</option>
                                                    <option value="3">março</option>
                                                    <option value="4">abril</option>
                                                    <option value="5">maio</option>
                                                    <option value="6">junho</option>
                                                    <option value="7">julho</option>
                                                    <option value="8">agosto</option>
                                                    <option value="9">setembro</option>
                                                    <option value="10">outubro</option>
                                                    <option value="11">novembro</option>
                                                    <option value="12">dezembro</option>
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <button class="btn btn-primary" type="submit">Filtrar</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-12 pb-3 d-flex justify-content-end">
                                <form action="{{url('/eventos/busca')}}" class="w-100" type="get">
                                    <div class="row">
                                        <div class="col-9 text-right">
                                            <input name="query" type="search" class="form-control"
                                                placeholder="Buscar evento">
                                        </div>
                                        <div class="col-3">
                                            <button class="btn btn-primary" type="submit">Buscar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-12 text-right">
                                <a class="btn btn-primary" href="eventos/exportCSV">BAIXAR CSV</a>
                                <a class="btn btn-primary" href="eventos/exportXLSX">BAIXAR XLSX</a>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped w-100">
                    <thead class="thead-dark">
                        <tr>
                            <th>Id evento</th>
                            <th>Id do docente</th>
                            <th>Tipo de evento</th>
                            <th>Valor antigo</th>
                            <th>Valor novo</th>
                            <th>Lei vigente</th>
                            <th>Criado por</th>
                        </tr>
                    </thead>
                    @if(isset($eventos))
                    <tbody>
                        @foreach($eventos as $item)
                        <tr>
                            <td>{{$item->idEvento}}</td>
                            <td>{{$item->Docente_idDocente}}</td>
                            <td>{{$item->TipoEvento_idTipoEvento}}</td>
                            <td>{{$item->valorAntigo}}</td>
                            <td>{{$item->valorNovo}}</td>
                            <td>{{$item->Regra_idRegra}}</td>
                            <td>{{$item->Usuario_idUsuario}} em {{$item->dataEvento}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{$eventos->links()}}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
</div>
@endsection