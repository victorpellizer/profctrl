@extends('layouts.layout')

@section('title', 'Contato')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item">Contato</li>
                    <!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
                </ol>
<div class="row">
                    <div class="col-xl-4 offset-xl-1">
                        <div class="box" style="text-align: center;"><img class="rounded-circle" src="assets/img/gus.jpg" width="300px">
                            <h3 class="name">Gustavo Rosas</h3>
                            <p class="title">Desenvolvedor</p>
                            <div class="social" style="text-align: center;"><a href="https://www.facebook.com/gustavo.rosas.9212"><i class="fa fa-facebook-official"></i></a><a href="#"></a><a href="https://www.instagram.com/guuhrosas/?hl=pt-br"><i class="fa fa-instagram"></i></a><br>Whatsapp <i class="fa fa-whatsapp"></i>: (42) 9 9841-8293</div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-xl-4" style="text-align: center;">
                        <div class="box"><img class="rounded-circle" src="assets/img/victor.jpg" width="300px">
                            <h3 class="name">Victor Pellizer Iritsu</h3>
                            <p class="title">Desenvolvedor</p>
                            <div class="social" style="text-align: center;"><a href="https://www.facebook.com/victor.iritsu"><i class="fa fa-facebook-official"></i></a><a href="#"></a><a href="https://www.instagram.com/victorpellizer/?hl=pt-br"><i class="fa fa-instagram"></i></a><br>Whatsapp <i class="fa fa-whatsapp"></i>: (42) 9 9139-5876</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 offset-xl-2">
             <hr>
                        <br>
                        <h5 style="float: center">Email <i class="fa fa-file-text-o"></i>: profctrl.uepg2019@gmail.com</h5>
                </div>
            </div>   
@endsection
