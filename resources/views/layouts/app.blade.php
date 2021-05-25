<!doctype html>
<!-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> -->
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('pageTitle') PetHero</title>

    <!-- Scripts -->
    <!-- {{-- <script src="{{ asset('js/app.js') }}" defer></script> Esta línea causa un bug con el navbar D: --}} -->
    <script src="//cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<?php
$type = '';
$id = Auth::id();
use App\Models\PetOwner;
use App\Models\StoreOwner;
use App\Models\Walker;
$pet = PetOwner::find($id);
$store = StoreOwner::find($id);
$walker = Walker::find($id);
if (isset($pet)) {
$type = 'petOwner';
} //Manera rústica de diferenciar el usuario
if (isset($store)) {
$type = 'storeOwner';
}
if (isset($walker)) {
$type = 'walker';
}
?>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm">
            <div class="container">	
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="/uploads/Logo.png"
                        style="width: 35px; height:35px; position:relative; left:9px; border-radious:50%; margin:10px;" />
                    PetHero
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->

                        @guest


                            @if (Route::has('login'))
                               
                                   
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Foro
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('forum.index') }}">Ir el foro</a>
                                </div>

                            </li>

                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Tiendas
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('store.indexAll') }}">Ver todas las
                                            tiendas</a>
                                    </div>

                                </li>

                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Paseadores
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('walker.index') }}">Ver todos los paseadores</a>
                                    </div>

                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar Sesión') }}</a>

                                </li>



                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/registerOptions') }}">{{ __('Registrarse') }}</a>
                                </li>
                            @endif


                        @else


                            @if ($type == 'storeOwner')
                                <li class="nav-item dropdown">


                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            Tiendas
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('store.indexAll') }}">Ver todas las
                                                tiendas</a>
                                        </div>
    
                                    </li>
    
    
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            Foro
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('forum.index') }}">Ver foro completo</a>
                                            <a class="dropdown-item" href="{{ route('post.index') }}"> Ver mis
                                                publicaciones</a>
                                        </div>
                                    </li>

                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            <img src="/uploads/avatars/{{ Auth::user()->avatar }}"
                                                style="width: 35px; height:35px; position:relarive; left:9px; border-radious:50%;" />
                                            {{ Auth::user()->name }}
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item"
                                                href="{{ route('storeOwner.profile', Auth::user()->id) }}"> Ver perfil
                                                público</a>
                                            <a class="dropdown-item" href="{{ route('storeOwner.show', Auth::user()->id) }}">
                                                Ver perfil privado</a>
                                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                    document.getElementById('logout-form').submit();">
                                                {{ __('Cerrar Sesión') }}
                                            </a>
                                        </div> 
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>

                                </li>
                            @endif

                            @if ($type == 'petOwner')
                                <li class="nav-item dropdown">

                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            Mascotas
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('pet.index') }}">Ver todas las
                                                mascotas</a>
                                        </div>
    
                                    </li>

                                    <li class="nav-item dropdown">

                                        <li class="nav-item dropdown">
                                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                Paseos
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="{{ route('walk.index') }}">Ver todos los paseos</a>
                                                <a class="dropdown-item" href="{{ route('walk.indexPending') }}">Gestionar paseos pendientes</a>
                                                <a class="dropdown-item" href="{{ route('walk.indexActive') }}">Gestionar paseos en curso</a>
                                                <a class="dropdown-item" href="{{ route('walk.indexFinished') }}">Ver paseos finalizados</a>
                                                <a class="dropdown-item" href="{{ route('walk.petIndexRequests') }}">Ver mis solicitudes pendientes</a>
                                            </div>
        
                                        </li>

                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            Tiendas
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('store.indexAll') }}">Ver todas las tiendas</a>
                                            <a class="dropdown-item" href="{{ route('favoriteStore.index') }}">Ver tiendas favoritas</a>

                                        </div>
    
                                    </li>
    
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            Paseadores
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('walker.index') }}">Ver todos los paseadores</a>
                                            <a class="dropdown-item" href="{{ route('favoriteWalker.index') }}">Ver  paseadores favoritos</a>

                                        </div>
    
                                    </li>
    
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            Foro
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('forum.index') }}">Ver foro completo</a>
                                            <a class="dropdown-item" href="{{ route('post.index') }}"> Ver mis
                                                publicaciones</a>
                                        </div>
    
                                    </li>

                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            <img src="/uploads/avatars/{{ Auth::user()->avatar }}"
                                                style="width: 35px; height:35px; position:relarive; left:9px; border-radious:50%;" />
                                            {{ Auth::user()->name }}
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('petOwner.profile', Auth::user()->id) }}">
                                                Ver perfil público</a>
                                            <a class="dropdown-item" href="{{ route('petOwner.show', Auth::user()->id) }}"> Ver
                                                perfil privado</a>
                                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                                {{ __('Cerrar Sesión') }}
                                             </a>
                                        </div> 

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>

                                </li>
                            @endif
                            @if ($type == 'walker')
                                 <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Tiendas
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('store.indexAll') }}">Ver todas las
                                            tiendas</a>
                                    </div>

                                </li>

                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Paseadores
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('walker.index') }}">Ver todos los paseadores</a>
                                    </div>

                                </li>

                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Foro
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('forum.index') }}">Ver foro completo</a>
                                        <a class="dropdown-item" href="{{ route('post.index') }}"> Ver mis
                                            publicaciones</a>
                                    </div>

                                </li>


                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Paseos
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('walk.walkerIndex') }}">Gestionar todos mis paseos</a>
                                        <a class="dropdown-item" href="{{ route('walk.walkerIndexPending') }}">Gestionar paseos pendientes</a>
                                        <a class="dropdown-item" href="{{ route('walk.walkerIndexActive') }}">Gestionar paseos en curso</a>
                                        <a class="dropdown-item" href="{{ route('walk.walkerIndexFinished') }}">Ver paseos finalizados</a>
                                        <a class="dropdown-item" href="{{ route('walk.indexRequests') }}">Ver solicitudes disponibles</a>
                                    </div>

                                </li>
                                <li class="nav-item dropdown">

                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            <img src="/uploads/avatars/{{ Auth::user()->avatar }}"
                                                style="width: 35px; height:35px; position:relarive; left:9px; border-radious:50%;" />
                                            {{ Auth::user()->name }}
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('walker.profile', Auth::user()->id) }}">
                                                Ver perfil público</a>
                                            <a class="dropdown-item" href="{{ route('walker.show', Auth::user()->id) }}"> Ver
                                                perfil privado</a>
                                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                    document.getElementById('logout-form').submit();">
                                                {{ __('Cerrar Sesión') }}
                                            </a>
                                            
                
                                            
                                        </div>
                                        
                                        {{-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                    document.getElementById('logout-form').submit();">
                                                {{ __('Cerrar Sesión') }}
                                            </a>
                                        </div> --}}
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>

                                    <!-- <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        PERFIL (Paseador)
                                    </a> -->
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('walker.profile', Auth::user()->id) }}">
                                            Ver perfil público</a>
                                        <a class="dropdown-item" href="{{ route('walker.show', Auth::user()->id) }}"> Ver
                                            perfil privado</a>
                                    </div> --}}


                                


                                </li>
                            @endif

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                @if (Session::has('_success'))
                    <div class="alert alert-success"><img
                            src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgMzY3LjgwNSAzNjcuODA1IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCAzNjcuODA1IDM2Ny44MDU7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxnPg0KCTxwYXRoIHN0eWxlPSJmaWxsOiMzQkI1NEE7IiBkPSJNMTgzLjkwMywwLjAwMWMxMDEuNTY2LDAsMTgzLjkwMiw4Mi4zMzYsMTgzLjkwMiwxODMuOTAycy04Mi4zMzYsMTgzLjkwMi0xODMuOTAyLDE4My45MDINCgkJUzAuMDAxLDI4NS40NjksMC4wMDEsMTgzLjkwM2wwLDBDLTAuMjg4LDgyLjYyNSw4MS41NzksMC4yOSwxODIuODU2LDAuMDAxQzE4My4yMDUsMCwxODMuNTU0LDAsMTgzLjkwMywwLjAwMXoiLz4NCgk8cG9seWdvbiBzdHlsZT0iZmlsbDojRDRFMUY0OyIgcG9pbnRzPSIyODUuNzgsMTMzLjIyNSAxNTUuMTY4LDI2My44MzcgODIuMDI1LDE5MS4yMTcgMTExLjgwNSwxNjEuOTYgMTU1LjE2OCwyMDQuODAxIA0KCQkyNTYuMDAxLDEwMy45NjggCSIvPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPC9zdmc+DQo="
                            height="24" />
                        {{ Session::get('_success') }}
                    </div>
                @endif
                @if (Session::has('_failure'))
                    <div class="alert alert-danger"><img
                            src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjUxMnB0IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgd2lkdGg9IjUxMnB0IiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxwYXRoIGQ9Im0yNTYgMGMtMTQxLjE2NDA2MiAwLTI1NiAxMTQuODM1OTM4LTI1NiAyNTZzMTE0LjgzNTkzOCAyNTYgMjU2IDI1NiAyNTYtMTE0LjgzNTkzOCAyNTYtMjU2LTExNC44MzU5MzgtMjU2LTI1Ni0yNTZ6bTAgMCIgZmlsbD0iI2Y0NDMzNiIvPjxwYXRoIGQ9Im0zNTAuMjczNDM4IDMyMC4xMDU0NjljOC4zMzk4NDMgOC4zNDM3NSA4LjMzOTg0MyAyMS44MjQyMTkgMCAzMC4xNjc5NjktNC4xNjAxNTcgNC4xNjAxNTYtOS42MjEwOTQgNi4yNS0xNS4wODU5MzggNi4yNS01LjQ2MDkzOCAwLTEwLjkyMTg3NS0yLjA4OTg0NC0xNS4wODIwMzEtNi4yNWwtNjQuMTA1NDY5LTY0LjEwOTM3Ni02NC4xMDU0NjkgNjQuMTA5Mzc2Yy00LjE2MDE1NiA0LjE2MDE1Ni05LjYyMTA5MyA2LjI1LTE1LjA4MjAzMSA2LjI1LTUuNDY0ODQ0IDAtMTAuOTI1NzgxLTIuMDg5ODQ0LTE1LjA4NTkzOC02LjI1LTguMzM5ODQzLTguMzQzNzUtOC4zMzk4NDMtMjEuODI0MjE5IDAtMzAuMTY3OTY5bDY0LjEwOTM3Ni02NC4xMDU0NjktNjQuMTA5Mzc2LTY0LjEwNTQ2OWMtOC4zMzk4NDMtOC4zNDM3NS04LjMzOTg0My0yMS44MjQyMTkgMC0zMC4xNjc5NjkgOC4zNDM3NS04LjMzOTg0MyAyMS44MjQyMTktOC4zMzk4NDMgMzAuMTY3OTY5IDBsNjQuMTA1NDY5IDY0LjEwOTM3NiA2NC4xMDU0NjktNjQuMTA5Mzc2YzguMzQzNzUtOC4zMzk4NDMgMjEuODI0MjE5LTguMzM5ODQzIDMwLjE2Nzk2OSAwIDguMzM5ODQzIDguMzQzNzUgOC4zMzk4NDMgMjEuODI0MjE5IDAgMzAuMTY3OTY5bC02NC4xMDkzNzYgNjQuMTA1NDY5em0wIDAiIGZpbGw9IiNmYWZhZmEiLz48L3N2Zz4="
                            height="24" />
                        {{ Session::get('_failure') }}
                    </div>
                @endif
            </div>
            @yield('content')
        </main>
    </div>
</body>

</html>
