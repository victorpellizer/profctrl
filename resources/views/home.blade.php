@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Bem vindo ao Profctrl</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <button type="button" class="btn btn-info">Docente</button>
                    <button type="button" class="btn btn-info">Info</button>
                    <button type="button" class="btn btn-info">Info</button>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
