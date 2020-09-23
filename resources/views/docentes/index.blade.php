@extends('layouts.layout')

@section('title', 'Docentes')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item">Docentes</li>
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
                        <h3>Lista de Docentes <i class="fa fa-info-circle btn btn-secundary" style="float: right" data-toggle="tooltip" data-placement="top" title="Aqui estão as informações cadastrais dos docentes, você pode navegar facilmente por todos eles e selecionar um docente para edição. Clique na coluna para ordenar de forma crescente ou decrescente ou mantenha o cursor do mouse em cima de um cabeçalho da coluna para mais informações."></i></h3>
                        

                        <hr>
                        

                        <table class="table display responsive no-wrap table-striped" id="tabela-docente">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" data-toggle="tooltip" data-placement="top" title="Nome completo do Docente.">Nome</th>
                                    <th scope="col" data-toggle="tooltip" data-placement="top" title="Número de Matrícula do Docente.">Matricula</th>
                                    <th scope="col" data-toggle="tooltip" data-placement="top" title="Cargo que o Docente passou no concurso público.">Cargo</th>
                                    <th scope="col" data-toggle="tooltip" data-placement="top" title="Pontos de Desempenho acumulados. Estes Pontos são utilizados para progressão horizontal (Classe) de carreira.">Pontos de Desempenho</th>
                                    <th scope="col" data-toggle="tooltip" data-placement="top" title="Carga Horária do Docente (20 horas ou 40 horas).">Carga Horaria</th>
                                    <th scope="col" data-toggle="tooltip" data-placement="top" title="Tempo de Serviço do Docente. Este valor é utilizado para contabilizar uma das remunerações do Docente.">Tempo de Servico</th>

                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table> 
    
    


                        <a href="{{action('DocenteController@create')}}"><button type="button" class="btn btn-success">Cadastrar Novo Docente <i class="fa fa-user-o"></i></button></a>
                        <a class="btn btn-info" href="{{route('home')}}">Voltar <i class="fa fa-arrow-left"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
    $('#tabela-docente').DataTable({
                ajax: {
                    url: '{!! route('docentelist') !!}',
                    error: function (xhr, error, thrown){
                        alert('Ocorreu algum erro. Recarregue a página.');
                    }
                },
                columns: [
                    { 
         "data": "nomeDocente", "name":'nomeDocente',
         "render": function(data, type, row, meta){
            if(type === 'display'){
                data = '<a href="/docentes/' + row.idDocente + '/show" >' + data + '</a>';
            }
            
            return data;
         }
      },
                    { data: 'matricula', name: 'matricula' },
                    { data: 'cargo', name: 'cargo' },
                    { data: 'pontosDeDesempenho', name: 'pontosDeDesempenho' },
                    { data: 'cargaHoraria', name: 'cargaHoraria' },
                    { data: 'tempoDeServico', name: 'tempoDeServico' }
                ],
                "order": [[0, "asc"]],
                "lengthMenu": [10, 20, 30],
                "language": {
                    "lengthMenu": "Mostrando _MENU_ usuários por página",
                    "zeroRecords": "Nada encontrado",
                    "info": "Mostrando página _PAGE_ de _PAGES_ de um total de _MAX_ usuários",
                    "infoEmpty": "Nenhum usuário cadastrado",
                    "infoFiltered": "(filtrado de _MAX_ registros no total)",
                    "search": "Buscar:",
                    "paginate": {
                        "first":      "Primeira",
                        "last":       "Última",
                        "next":       "Próxima",
                        "previous":   "Anterior"
                    },
                    "loadingRecords": "Carregando...",
                    "processing":     "Carregando...",
                    "emptyTable":     "Nada Encontrado!"
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
