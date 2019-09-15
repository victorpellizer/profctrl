@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('docente.index')}}">Docentes</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cadastro</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header">Cadastro de Docente</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <form method="POST" action="{{ route('docente.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Matrícula</label>

                            <div class="col-md-2">
                                <input id="matricula" type="number" class="form-control @error('name') is-invalid @enderror" name="matricula" value="{{ old('matricula') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nomeDocente" class="col-md-4 col-form-label text-md-right">Nome</label>

                            <div class="col-md-6">
                                <input id="nomeDocente" type="text" class="form-control @error('nomeDocente') is-invalid @enderror" name="nomeDocente" value="{{ old('nomeDocente') }}" required autocomplete="nomeDocente" autofocus>

                                @error('nomeDocente')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cargo" class="col-md-4 col-form-label text-md-right">Cargo</label>

                            <div class="col-md-6">
                                <input id="cargo" type="text" class="form-control @error('cargo') is-invalid @enderror" name="cargo" value="{{ old('cargo') }}" required autocomplete="cargo" autofocus>

                                @error('cargo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="pontosDeDesempenho" class="col-md-4 col-form-label text-md-right">Pontos</label>

                            <div class="col-md-2">
                                <input id="pontosDeDesempenho" type="number" class="form-control @error('pontosDeDesempenho') is-invalid @enderror" name="pontosDeDesempenho" value="{{ old('pontosDeDesempenho') }}" required autocomplete="pontosDeDesempenho" autofocus>

                                @error('pontosDeDesempenho')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cargaHoraria" class="col-md-4 col-form-label text-md-right">Carga Horaria</label>

                            <div class="col-md-2">
                                <input id="cargaHoraria" type="number" class="form-control @error('cargaHoraria') is-invalid @enderror" name="cargaHoraria" value="{{ old('cargaHoraria') }}" required autocomplete="cargaHoraria" autofocus>

                                @error('cargaHoraria')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tempoDeServico" class="col-md-4 col-form-label text-md-right">Tempo De Servico</label>

                            <div class="col-md-2">
                                <input id="tempoDeServico" type="number" class="form-control @error('tempoDeServico') is-invalid @enderror" name="tempoDeServico" value="{{ old('tempoDeServico') }}" required autocomplete="tempoDeServico" autofocus>

                                @error('tempoDeServico')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cidade" class="col-md-4 col-form-label text-md-right">Cidade</label>

                            <div class="col-md-6">
                                <input id="cidade" type="text" class="form-control @error('cidade') is-invalid @enderror" name="cidade" value="{{ old('cidade') }}" required autocomplete="nomeDocente" autofocus>

                                @error('cidade')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                     Cadastrar
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
