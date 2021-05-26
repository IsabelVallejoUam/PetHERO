@extends('layouts.app')

@section('content')

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Gmap</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{route('location.index')}}">Cargar Ubicaciones<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">Ver Mapa</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container-fluid" style="margin-top: 25px; margin-bottom: 50px">
    <div class="row">

        <div class="col-12" >
            <div id="map_canvas" style="width: auto; height: 600px;"></div>
        </div>

    </div>
</div>

<script src="{{asset('assets/js/map.js')}}"></script>