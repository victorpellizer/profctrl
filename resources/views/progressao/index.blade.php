@extends('layouts.layout')

@section('title', 'Dados profissionais')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{action('HomeController@index')}}">Home</a></li>
                    <li class="breadcrumb-item">Dados profissionais</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="row p-3">
                        <div class="col-6">
                            <h3>Dados profissionais</h3>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-12 pb-3 d-flex justify-content-end">
                                    <form action="{{url('/progressao/busca')}}" class="w-100" type="get">
                                        <div class="row">
                                            <div class="col-9 text-right">
                                                <input name="query" type="search" class="form-control" placeholder="Buscar docente">
                                            </div>
                                            <div class="col-3">
                                                <button class="btn btn-primary" type="submit">Buscar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-12 text-right">
                            <a class="btn btn-primary" href="progressao/exportCSV">BAIXAR CSV</a>
                            <a class="btn btn-primary" href="progressao/exportXLSX">BAIXAR XLSX</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped w-100">
                        <thead class="thead-dark">
                            <tr>
                                <th title="Nome completo do docente">
                                    Nome
                                </th>
                                <th title="Matrícula do docente">
                                    Matrícula
                                </th>
                                <th title="Nível do docente (A-D)">
                                    Nível
                                </th>
                                <th title="Classe do docente (1-15)">
                                    Classe
                                </th>
                                <th title="Instituição onde o docente está lotado">
                                    Lotação
                                </th>
                                <th title="Função do docente">
                                    Função
                                </th>
                                <th title="Remuneração do docente, composta por salário, tempo de serviço, gratificação e deslocamento">
                                    Remuneração
                                </th>
                            </tr>
                        </thead>
                    @if(isset($docentes))
                        <tbody>
                        @foreach($docentes as $item)
                            <tr>
                                <td><a href="/docentes/{{$item->idDocente}}">{{$item->nomeDocente}}</a></td>
                                <td>{{$item->matricula}}</td>
                                <td>{{$item->nivel}}</td>
                                <td>{{$item->classe}}</td>
                                <td>{{$item->lotacao}}</td>
                                <td>{{$item->funcao}}</td>
                                <td>R$ {{$item->beneficioTotal}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{$docentes->links()}}
                    </div>
                    @endif
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