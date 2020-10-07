<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - ProfCtrl</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
 
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/nunito.css') }} ">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome5-overrides.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/Contact-Form-Clean.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/Login-Form-Dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/Navigation-with-Search.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/Team-Boxed.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/searchbar.css')}}">
    <link rel="icon" type="imagem/png" href="{{ asset('assets/img/logo_profctrl.png') }}" />
    
</head>

<body>
    <div id="app">
        <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 rounded-right">
            <div class="container-fluid d-flex flex-column p-0">
                <ul class="nav navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item" role="presentation"></li>
                </ul>
                <div class="text-center d-none d-md-inline"></div>
                <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
                    <div class="container-fluid d-flex flex-column p-0">
                        <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="{{action('HomeController@index')}}">
                            <div class="sidebar-brand-icon rotate-n-15"></div>
                            <div class="sidebar-brand-text mx-3"><span>ProfCtrl</span></div><img src="{{ asset('assets/img/logo_profctrl.png') }}" width="70" height="70"></a>
                        <hr class="sidebar-divider my-0">
                        <ul class="nav navbar-nav text-light" id="accordionSidebar">
                            <li class="nav-item" role="presentation"><a class="nav-link" href="{{action('HomeController@index')}}"><span><i class="fa fa-dashboard"></i>Home</span></a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="{{action('DocenteController@index')}}"><i class="fa fa-user-o"></i>Docentes</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="{{action('EventoController@index')}}"><i class="fa fa-user-o"></i>Eventos</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="{{action('ProgressaoController@index')}}"><i class="fa fa-list-ul"></i>Progressão</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="{{action('LicencaController@index')}}"><i class="fa fa-plus-square"></i>Licenças</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="{{action('TituloController@index')}}"><i class="fa fa-graduation-cap"></i>Títulos</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="{{action('InformacoesController@index')}}"><i class="fa fa-info-circle"></i>Informações Gerais</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="{{action('ContatoController@index')}}"><i class="fa fa-phone"></i>Contato</a></li>
                            </a>
                            </ul>

                            <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Logar') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrar') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropright">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Sair') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                        </ul>
                    </div>
                </nav>
            </div>
        </nav>

        <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
        
        
        <main class="py-4">
            @yield('content')
        </main>
<footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © Profctrl 2019</span></div>
                </div>
            </footer>
    </div>



    <!-- Scripts -->
    <!--<script src="{{ asset('js/app.js') }}" defer></script>-->
    <!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/popper.min.js')}}" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <!-- <script src="assets/js/jquery.min.js"></script> -->
    <!--  <script src="assets/js/jquery-3.3.1.js"></script> -->
    <script type="text/javascript" src="{{asset('assets/js/datatables.js')}}"></script>
    <script src="{{asset('assets/js/datatables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('assets/js/jszip.min.js')}}"></script>
    <script src="{{asset('assets/js/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/js/vfs.fonts.js')}}"></script>
    <script src="{{asset('assets/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/js/buttons.print.min.js')}}"></script> 
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
    <script src="{{asset('assets/js/theme.js')}}"></script>
    <script src="{{asset('assets/js/moment.js')}}"></script>

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })  
    </script> 

    <script>
        $(".alert").fadeTo(3000, 500).slideUp(500, function(){
            $(".alert").alert('close');
        });
    </script>


    @stack('scripts')
</body>

</html>
