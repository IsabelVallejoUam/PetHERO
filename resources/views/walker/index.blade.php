@extends('layouts.app')

@section('content')
    <div class="card">
        <h1>
            PASEADORES
        </h1>
        <div class="container">
        @foreach ( $walkers as $walker) 
            <div class="card col-md-6" style = "width: 20rem; margin:10px; display:inline-block;" >
                <img class="card-img-top" src="/uploads/avatars/{{$walker->avatar}}">
                <div class="card-body">
                    <h5 class="card-title"><b> {{$walker->name}}</b></h5>
                    <p class="card-subtitle mb-2 text-muted"><b>Puntuacion:{{$walker->score}}</b></p>
                    <p class="card-text">Slogan:{{$walker->slogan}}</p>
                    <a href="{{ route('walker.profile', $walker->user_id) }}" class="btn btn-secondary">Ver Perfil</a>
                </div>
            </div>  
        @endforeach 
        </div>
    </div>
@endsection
