@extends('layouts.app')

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
                <div class="card-header">Edição de Progressão de Carreira - Docente {{$docente->nomeDocente}}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('progressao.update',$docente->idDocente) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="classe" class="col-md-4 col-form-label text-md-right">Classe</label>

                            <div class="col-md-2">
                                <input id="classe" type="text" class="form-control @error('classe') is-invalid @enderror" name="classe" value="{{$docente->classes}}" required autocomplete="classe" autofocus>

                                @error('classe')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="nivel" class="col-md-4 col-form-label text-md-right">Nível</label>

                            <div class="col-md-6">
                                <input id="nivel" type="text" class="form-control @error('nivel') is-invalid @enderror" name="nivel" value="{{ $docente->niveis }}" required autocomplete="nivel" autofocus>

                                @error('nivel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="remuneracao" class="col-md-4 col-form-label text-md-right">Remuneração</label>

                            <div class="col-md-2">
                                <input id="remuneracao" type="number" class="form-control @error('remuneracao') is-invalid @enderror" name="remuneracao" value="{{ $docente->valorTotalRemuneracao() }}" required autocomplete="remuneracao" autofocus>

                                @error('remuneracao')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="titulo" class="col-md-4 col-form-label text-md-right">Títulos</label>

                            <div class="col-md-2">
                                <input id="titulo" type="text" class="form-control @error('titulo') is-invalid @enderror" name="titulo" value="{{ $docente->titulo }}" required autocomplete="titulo" autofocus>

                                @error('titulo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="licenca" class="col-md-4 col-form-label text-md-right">Licenças</label>

                            <div class="col-md-6">
                                <input id="licenca" type="text" class="form-control @error('licenca') is-invalid @enderror" name="licenca" value="{{ $docente->licenca }}" required autocomplete="licenca" autofocus>

                                @error('licenca')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                     Salvar
                                </button>
                            </div>
                        </div>
                    </form>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
