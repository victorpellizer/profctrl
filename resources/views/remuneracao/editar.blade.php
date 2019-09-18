@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('progressao.index')}}">Progressão de Carreira</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header">Edição de Remuneração - Docente {{$docente->nomeDocente}}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('remuneracao.store') }}">
                        @csrf


                        <div class="form-group row">
                            <label for="remuneracao" class="col-md-4 col-form-label text-md-right">Remuneração</label>

                            <div class="col-md-2">
                                <input id="remuneracao" type="number" class="form-control @error('remuneracao') is-invalid @enderror" name="remuneracao" value="{{ $docente->remuneracao }}" required autocomplete="remuneracao" autofocus>

                                @error('remuneracao')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                    </form>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
