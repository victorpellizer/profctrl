@extends('layouts.layout')

@section('title', 'Editar Classe')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="width: 100%">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{action('DocenteController@index')}}">Docentes</a></li>
                    <li class="breadcrumb-item"><a href="{{action('DocenteController@show',$docente->idDocente)}}">Perfil - {{$docente->nomeDocente}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar Classe do Docente</li>
                </ol>
            </nav>

            @if(session('success'))


            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Classe atualizada com Sucesso!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            @elseif(session('error'))

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Erro ao atualizar classe!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>

            @endif

            <div class="card">
                    <div class="card-body">
                        <h3>Classe do Docente - {{$docente->nomeDocente}}</h3>
                        <hr>
<form method="POST" action="{{action('ClasseController@update',$docente->idDocente)}}">
@csrf
@method('PUT')
    <h5>Alterar Classe</h5>
    <h6>*Deve-se ocorrer alteração na classe somente a cada 2 anos* e/ou mediante Pontos de Desempenho maior que 100. A mudança de classe influencia na mudança de salário.*</h6>
        <select id="classe" class="form-control @error('classe') is-invalid @enderror" style="width: 80px" name="classe">
            <option value="1" {{$docente->classe=="1" ? 'selected' : ''}}>1</option>
            <option value="2" {{$docente->classe=="2" ? 'selected' : ''}}>2</option>
            <option value="3" {{$docente->classe=="3" ? 'selected' : ''}}>3</option>
            <option value="4" {{$docente->classe=="4" ? 'selected' : ''}}>4</option>
            <option value="5" {{$docente->classe=="5" ? 'selected' : ''}}>5</option>
            <option value="6" {{$docente->classe=="6" ? 'selected' : ''}}>6</option>
            <option value="7" {{$docente->classe=="7" ? 'selected' : ''}}>7</option>
            <option value="8" {{$docente->classe=="8" ? 'selected' : ''}}>8</option>
            <option value="9" {{$docente->classe=="9" ? 'selected' : ''}}>9</option>
            <option value="10" {{$docente->classe=="10" ? 'selected' : ''}}>10</option>
            <option value="11" {{$docente->classe=="11" ? 'selected' : ''}}>11</option>
            <option value="12" {{$docente->classe=="12" ? 'selected' : ''}}>12</option>
            <option value="13" {{$docente->classe=="13" ? 'selected' : ''}}>13</option>
            <option value="14" {{$docente->classe=="14" ? 'selected' : ''}}>14</option>
            <option value="15" {{$docente->classe=="15" ? 'selected' : ''}}>15</option>
        </select>
        <br>
        <button type="submit" class="btn btn-success">Salvar <i class="fa fa-save"></i>
    </button>
    <a class="btn btn-info" href="{{action('DocenteController@show',$docente->idDocente)}}">Voltar <i class="fa fa-arrow-left"></i></a>
        <hr>

        <h5>Histórico de alterações de Classe</h5>
        <table class="table display responsive no-wrap table-striped" style="width: 600px">
        <thead>
        <tr>
            <th style="width: 200px">Classe</th>
            <th style="width: 400px">Editado por</th>
        </tr>
        </thead>

        <tbody>
             @foreach($classes as $c)
             <tr>
            <td>{{$c->nome}}</td>
            <td>{{$c->usuario}} em {{$c->data}}</td>
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
