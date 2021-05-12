@extends('layouts.app')

@section('content')

    <div class="jumbotron">
        <h1>Paseadores Favoritos</h1>
        
      
            <div class="row-fluid ">
            @foreach ( $walkers as $walker) 
            <div class="card" style="display:inline-block; margin:10px;">
                    <div class="col-sm-12 d-flex">
                        <div class="card  bg-light" style = "width: 22rem; " >
                            <img class="card-img-top" src="/uploads/avatars/{{$walker->avatar}}" alt={{$walker->name}}>

        
                            <div class="card-body">
                                <h5 class="card-title"><b> {{$walker->name}}</b></h5>
                                <p class="card-subtitle mb-2 text-muted"><b>Puntuacion:{{$walker->score}}</b></p>
                                <p class="card-text">Slogan:{{$walker->slogan}}</p>
                                <a href="{{ route('walker.profile', $walker->id) }}" class="btn btn-secondary">Ver Perfil</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach 
            </div>
    
    </div>

@endsection
