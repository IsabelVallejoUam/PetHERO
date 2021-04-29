@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>PASEADORES</h1>
        
      
            <div class="row-fluid ">
            @foreach ( $walkers as $walker) 
                <div class="col-sm-4 ">
                    <div class="card-columns-fluid">
                        <div class="card  bg-light" style = "width: 22rem; " >
                            <img class="card-img-top" src="/uploads/avatars/{{$walker->avatar}}" alt="Foto de perfil">

        
                            <div class="card-body">
                                <h5 class="card-title"><b> {{$walker->name}}</b></h5>
                                <p class="card-subtitle mb-2 text-muted"><b>Puntuacion:{{$walker->score}}</b></p>
                                <p class="card-text">Slogan:{{$walker->slogan}}</p>
                                <p class="card-text">Precio por Paseo:{{$walker->rate}}$</p>
                                <a href="{{ route('walker.profile', $walker->user_id) }}" class="btn btn-secondary">Ver Perfil</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach 
            </div>
    
    </div>

@endsection
