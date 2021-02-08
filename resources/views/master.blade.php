<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="routeName" content="{{ Route::currentRouteName() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="{{ url('/static/css/style.css?v='.time()) }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;1,100&display=swap" rel="stylesheet">
    <title>@yield('title') - {{ Config::get('madecms.name') }}</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/')}}"><img src="{{ url('/static/images/madecms_logo2.png') }}" class="img-fluid"/></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <span class="me-auto"></span>
                <div class="d-flex ml-auto">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ url('/')}}"><i class="fas fa-home"></i> Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ url('/store')}}"><i class="fas fa-store-alt"></i> Tienda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ url('/')}}"><i class="fas fa-id-card-alt"></i> Sobre Nosotros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ url('/')}}"><i class="fas fa-envelope-open"></i> Contacto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ url('/car')}}"><i class="fas fa-shopping-cart"></i> <span class="carnumber">0</span></a>
                        </li>
                        @if(Auth::guest())
                            <li class="nav-item link-acc">
                                <a class="nav-link btn" aria-current="page" href="{{ url('/login')}}"><i class="fas fa-fingerprint"></i> Ingresar</a>
                                <a class="nav-link btn" aria-current="page" href="{{ url('/register')}}"><i class="fas fa-user-circle"></i> Crear Cuenta</a>
                            </li>
                        @else
                            <li class="nav-item link-acc link-user dropdown">
                                <a class="nav-link btn dropdown-toggle"  id="mnUser" role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-current="page" href="#">
                                    @if(is_null(Auth::user()->avatar))
                                        <img src="{{ url('/static/images/Default_Avatar.png') }}"/>
                                    @else
                                        <img id="img" src="{{ url('/uploads_users/'.Auth::id().'/'.Auth::user()->avatar) }}">
                                    @endif
                                    Hola: {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu shadow" aria-labelledby="mnUser">
                                    @if(Auth::user()->role == 1)
                                        <li><a class="dropdown-item" href="{{ url('/admin') }}" target="_blank"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                    @endif
                                    <li><a class="dropdown-item" href="{{ url('/account/edit')}}"><i class="fas fa-address-card"></i> Editar Información</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/logout')}}"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    @include('common.alert')

    <div class="wrapper">
        <div class="container">
            @yield('content')
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ url('/static/js/site.js?v='.time()) }}"></script>
    @section('script')@show
</body>
</html>
