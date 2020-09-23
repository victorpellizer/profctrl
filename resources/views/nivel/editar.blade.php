@extends('layouts.layout')

@section('title', 'Editar Nível')

@section('content')<div class="container">
    <div class="row justify-content-center" style="width: 100%">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{action('DocenteController@index')}}">Docentes</a></li>
                    <li class="breadcrumb-item"><a href="{{action('DocenteController@show',$docente->idDocente)}}">Perfil - {{$docente->nomeDocente}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar Nível do Docente</li>
                </ol>
            </nav>

            @if(session('success'))


            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Nível atualizado com Sucesso!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            @elseif(session('error'))

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Erro ao atualizar nível!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>

            @endif


            <div class="card">
                    <div class="card-body">
                        <h5>Alterar Nível</h5>
                        <h6>*A Alteração de nível influencia na mudança de salário*</h6>
                        <hr>
<form method="POST" action="{{action('NivelController@update',$docente->idDocente)}}">
@csrf
@method('PUT')
<select class="form-control @error('nivel') is-invalid @enderror" style="width: 80px" name="nivel">
            <option value="1" {{$docente->nivel=="A" ? 'selected' : ''}}>A</option>
            <option value="2" {{$docente->nivel=="B" ? 'selected' : ''}}>B</option>
            <option value="3" {{$docente->nivel=="C" ? 'selected' : ''}}>C</option>
            <option value="4" {{$docente->nivel=="D" ? 'selected' : ''}}>D</option>
        </select>
        <br>
        <button type="submit" class="btn btn-success">Salvar <i class="fa fa-save"></i>
    </button>
    <a class="btn btn-info" href="{{action('DocenteController@show',$docente->idDocente)}}">Voltar <i class="fa fa-arrow-left"></i></a>
<hr>
<h5>Histórico de alterações de Nível</h5>

<table class="table display responsive no-wrap table-striped" style="width: 600px">
        <thead>
        <tr>
            <th style="width: 200px">Nível</th>
            <th style="width: 400px">Editado por</th>
        </tr>
        </thead>

        <tbody>
             @foreach($niveis as $n)
             <tr>
            <td>{{$n->nome}}</td>
            <td>{{$n->usuario}} em {{$n->data}}</td>
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
