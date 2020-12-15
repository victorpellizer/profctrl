@extends('layouts.layout')

@section('title', 'Editar lotação')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="width: 100%">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{action('DocenteController@index')}}">Docentes</a></li>
                    <li class="breadcrumb-item"><a
                            href="{{action('DocenteController@show',$docente->idDocente)}}">{{$docente->nomeDocente}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar lotação</li>
                </ol>
            </nav>
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{session('error')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h3>Editar lotação - {{$docente->nomeDocente}}</h3>
                    <hr>
                    <form method="POST" action="{{action('LotacaoController@update',$docente->idDocente)}}">
                        @csrf
                        @method('PUT')
                        <h5>Instituição</h5>
                        <select class="form-control @error('lotacao') is-invalid @enderror" style="width: 200px"
                            name="lotacao">
                            <option value="15" {{$docente->lotacao=="Sem Lotação" ? 'selected' : ''}}>Sem Lotação
                            </option>
                            <option value="1" {{$docente->lotacao=="Betânia" ? 'selected' : ''}}>Betânia</option>
                            <option value="2" {{$docente->lotacao=="Tônia Harms" ? 'selected' : ''}}>Tônia Harms
                            </option>
                            <option value="3" {{$docente->lotacao=="Geralda Harms" ? 'selected' : ''}}>Geralda Harms
                            </option>
                            <option value="4" {{$docente->lotacao=="Fátima A. Bosa" ? 'selected' : ''}}>Fátima A. Bosa
                            </option>
                            <option value="5" {{$docente->lotacao=="Canaã" ? 'selected' : ''}}>Canaã</option>
                            <option value="6" {{$docente->lotacao=="Limpo Grande" ? 'selected' : ''}}>Limpo Grande
                            </option>
                            <option value="7" {{$docente->lotacao=="São Judas Tadeu" ? 'selected' : ''}}>São Judas Tadeu
                            </option>
                            <option value="8" {{$docente->lotacao=="José P. N. Rosas" ? 'selected' : ''}}>José P. N.
                                Rosas</option>
                            <option value="9" {{$docente->lotacao=="SMEC" ? 'selected' : ''}}>SMEC</option>
                            <option value="10" {{$docente->lotacao=="Sta Rita de Cássia" ? 'selected' : ''}}>Sta Rita de
                                Cassia</option>
                            <option value="11" {{$docente->lotacao=="Theresa G. Seifarth" ? 'selected' : ''}}>Theresa G.
                                Seifarth</option>
                            <option value="12" {{$docente->lotacao=="Santa Cruz" ? 'selected' : ''}}>Santa Cruz</option>
                            <option value="13" {{$docente->lotacao=="Dep. Alim Esc" ? 'selected' : ''}}>Dep. Alim. Esc
                            </option>
                            <option value="14" {{$docente->lotacao=="Biblioteca" ? 'selected' : ''}}>Biblioteca</option>

                        </select>
                        <br>
                        <button type="submit" class="btn btn-success">Salvar <i class="fa fa-save"></i>
                        </button>
                        <a class="btn btn-info" href="{{action('DocenteController@show',$docente->idDocente)}}">Voltar
                            <i class="fa fa-arrow-left"></i></a>
                        <hr>
                        <h5>Histórico de alterações na lotação:</h5>
                        <table class="table display responsive no-wrap table-striped" style="width: 600px">
                            <thead>
                                <tr>
                                    <th style="width: 400px">Instituição</th>
                                    <th style="width: 400px">Editado por</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lotacoes as $l)
                                <tr>
                                    <td>{{$l->nome}}</td>
                                    <td>{{$l->usuario}} em {{$l->data}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection