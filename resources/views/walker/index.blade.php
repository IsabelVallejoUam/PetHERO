@extends('layouts.app')

@section('content')
    <div class="card container">
        <h1>
            PASEADORES
        </h1>
        <div class="container">
        @foreach ( $walkers as $walker) 
            <div class="card col-md-6" style = "width: 20rem; margin:10px; display:inline-block;" >
                <h4 class="card-title text-center"><b> {{$walker->name}}</b></h4>
                <img class="card-img-top" src="/uploads/avatars/{{$walker->avatar}}">
                <div class="card-body">
                    <p class="card-text text-center"><i>"{{$walker->slogan}}"</i></p>       
                    <p class="card-subtitle mb-2 text-muted"><b>Puntuacion:{{$walker->score}}</b></p>
                    <p class="text-center">
                        <a href="{{ route('walker.profile', $walker->user_id) }}" class="btn btn-secondary">Ver Perfil</a>
                    </p>  
                </div>
            </div>  
        @endforeach 
        </div>
    </div>
@endsection
