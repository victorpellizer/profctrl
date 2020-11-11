@extends('layouts.layout')

@section('title', 'Docentes')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{action('HomeController@index')}}">Home</a></li>
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
                    <h3>Lista de Docentes <i class="fa fa-info-circle btn btn-secundary" style="float: right"
                            data-toggle="tooltip" data-placement="top"
                            title=""></i>
                    </h3>

                    <hr>
                    <table class="table table-striped" width="100%">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" data-toggle="tooltip" data-placement="top"
                                    title="Nome completo do Docente">
                                    Nome
                                </th>
                                <th scope="col" data-toggle="tooltip" data-placement="top"
                                    title="">
                                    Matrícula
                                </th>
                                <th scope="col" data-toggle="tooltip" data-placement="top"
                                    title="">
                                    Cargo
                                </th>
                                <th scope="col" data-toggle="tooltip" data-placement="top"
                                    title="">
                                    Pontos de Desempenho
                                </th>
                                <th scope="col" data-toggle="tooltip" data-placement="top"
                                    title="">
                                    Carga Horária
                                </th>
                                <th scope="col" data-toggle="tooltip" data-placement="top" title="">
                                    Tempo de Serviço
                                </th>
                            </tr>
                        </thead>
                        @foreach($docentes as $item)
                        <tbody style="float: center;background-color: #fff">
                            <th><a href="/docentes/{{$item->idDocente}}">{{$item->nomeDocente}}</a></th>
                            <th>{{$item->matricula}}</th>
                            <th>{{$item->cargo}}</th>
                            <th>{{$item->pontosDeDesempenho}}</th>
                            <th>{{$item->cargaHoraria}}</th>
                            <th>{{$item->tempoDeServico}}</th>
                        </tbody>
                        @endforeach

                    </table>
                    @endif
                    <div>
                        {{$docentes->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function fnExcelReport()
{
    var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
    var textRange; var j=0;
    tab = document.getElementById('headerTable'); // id of table

    for(j = 0 ; j < tab.rows.length ; j++) 
    {     
        tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
        //tab_text=tab_text+"</tr>";
    }

    tab_text=tab_text+"</table>";
    tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
    tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
    tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE "); 

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
    {
        txtArea1.document.open("txt/html","replace");
        txtArea1.document.write(tab_text);
        txtArea1.document.close();
        txtArea1.focus(); 
        sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
    }  
    else                 //other browser not tested on IE 11
        sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  

    return (sa);
}
</script>
@endsection