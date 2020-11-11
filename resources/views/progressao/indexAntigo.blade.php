@extends('layouts.layout')

@section('title', 'Progressão de Carreira')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{action('HomeController@index')}}">Home</a></li>
                    <li class="breadcrumb-item">Progressão de Carreira</li>
                    <!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
                </ol>
            </nav>
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    @if(isset($docentes))
                    <h3>Progressão de Carreira <i class="fa fa-info-circle btn btn-secundary" style="float: right"
                            data-toggle="tooltip" data-placement="top"
                            title="Aqui estão as informações de progressão de carreira dos docentes, você pode navegar facilmente por todos eles e selecioná-los para edição."></i>
                    </h3>

                    <hr>
                    <table id="tabela-progressao" class="table table-striped" width="
                        100%">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" data-toggle="tooltip" data-placement="top"
                                    title="Nome completo do Docente.">Nome</th>
                                <th scope="col" data-toggle="tooltip" data-placement="top"
                                    title="Nível do Docente (A-D).">Nível</th>
                                <th scope="col" data-toggle="tooltip" data-placement="top"
                                    title="Classe do Docente (1-15).">Classe</th>
                                <th scope="col" data-toggle="tooltip" data-placement="top"
                                    title="Instituição em que o Docente está lotado.">Lotação</th>

                                <th scope="col" data-toggle="tooltip" data-placement="top"
                                    title="Remuneração do Docente, composta por Salário, Tempo de Serviço, Gratificação e Deslocamento.">
                                    Remuneração</th>
                                <!--
                                        <th scope="col"data-toggle="tooltip" data-placement="top" title="Remuneração do Docente, composta por Salário, Tempo de Serviço, Gratificação e Deslocamento.">Salário</th>
                                    <th scope="col"data-toggle="tooltip" data-placement="top" title="Remuneração do Docente, composta por Salário, Tempo de Serviço, Gratificação e Deslocamento.">Des</th>
                                    <th scope="col"data-toggle="tooltip" data-placement="top" title="Remuneração do Docente, composta por Salário, Tempo de Serviço, Gratificação e Deslocamento.">TS</th>
                                    <th scope="col"data-toggle="tooltip" data-placement="top" title="Remuneração do Docente, composta por Salário, Tempo de Serviço, Gratificação e Deslocamento.">Grat</th>
                                   -->
                                <th scope="col" data-toggle="tooltip" data-placement="top" title="Status do Docente.">
                                    Status</th>
                            </tr>
                        </thead>
                        <tbody style="float: center">

                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    var table = $('#tabela-progressao').DataTable({
        ajax: {
            url: '{!! route('progressaoList') !!}',
            error: function(xhr, error, thrown) {
                alert('Ocorreu algum erro. Recarregue a página.');
            }
        },
        columns: [{
                data: 'nomeDocente',
                "render": function(data, type, row, meta) {
                    if (type === 'display') {
                        data = '<a href="/docentes/' + row.idDocente + '" >' + data + '</a>';
                    }
                    return data;
                }
            },
            {
                data: 'nivel',
                name: 'nivel'
            },
            {
                data: 'classe',
                name: 'classe'
            },
            {
                data: 'lotacao',
                name: 'lotacao'
            },
            {
                data: 'beneficioTotal',
                name: 'beneficioTotal'
            },
            {
                data: 'status',
                name: 'status'
            }
            /*,
                    { data: 'beneficioTotal', name: 'beneficioTotal'},
                    { data: 'beneficioS', name: 'beneficioS'},
                    { data: 'BeneficioD', name: 'BeneficioD'},
                    { data: 'BeneficioTS', name: 'BeneficioTS'},
                    { data: 'BeneficioG', name: 'BeneficioG'}
/*
                    { "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = '<a href="/titulos/' + row.idDocente + '" ><i class="fa fa-graduation-cap"></i></a>';
                        }
                    return data;
                    }
                    },
                    { "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = '<a href="/licencas/' + row.idDocente + '" ><i class="fa fa-plus-square"></i></a>';
                        }
                    return data;
                    }
                    },
                    
                    { data: 'status', name: 'status'}
                    */
        ],
        "order": [
            [0, "asc"]
        ],
        "lengthMenu": [10, 20, 30],
        "language": {
            "lengthMenu": "Mostrando _MENU_ usuários por página",
            "zeroRecords": "Nada encontrado",
            "info": "Mostrando página _PAGE_ de _PAGES_ de um total de _MAX_ usuários",
            "infoEmpty": "Nenhum usuário cadastrado",
            "infoFiltered": "(filtrado de _MAX_ registros no total)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primeira",
                "last": "Última",
                "next": "Próxima",
                "previous": "Anterior"
            },
            "loadingRecords": "Carregando...",
            "processing": "Carregando...",
            "emptyTable": "Nada Encontrado!"
        },

        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf', 'print'
        ]
    });
});
</script>

@endpush
@endsection