@extends('layouts.app')

@section('content')
<?php
    use App\Models\PetOwner;
    $type = '';
    $pet = PetOwner::find(Auth::id());
    if (isset($pet)) {
        $type = 'petOwner';
    } 
?>

<div>
    <div class="mx-auto pull-right">
        <div class="container" style="display:inline-block; color:black;">
            <form action="{{ route('walker.index') }}" method="GET" role="search">

                <div class="input-group">
                    <span class="input-group-btn mr-5 mt-1">
                        <button class="btn btn-info" type="submit" title="Buscar Paseador">
                            <span class="fas fa-search"></span>
                        </button>
                    </span>
                    <input type="text" class="form-control mr-2" name="term" placeholder="Buscar Paseador" id="term">
                   
                </div>
            </form>
        </div>
    </div>
</div>

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
                    <?php
                        $routes = \App\Models\Route::where('owner_id',$walker->id)->count();
                        $rate = \App\Models\Review::where('type','walk')->where('walker_id',$walker->user_id)->avg('rate');
                    ?>
                    @if($rate != null)
                        <p class="card-subtitle mb-2  text-center"><b>Puntuación:{{$rate}}/5</b></p>
                        <br>
                    @else
                    <p class="card-subtitle mb-2 text-muted text-center"><b>Aún no existen calificaciones</b></p>
                        <br>
                    @endif
                     
                    <p class="card-subtitle mb-2 text-center"><b>Rutas:{{$routes}}</b></p>
                    
                    <p class="text-center">
                        <a href="{{ route('walker.profile', $walker->user_id) }}" class="btn btn-secondary">Ver Perfil</a>
                    </p> 
                   
                    @if($type =='petOwner' && $routes >0)
                        <form action="{{route('walk.requestNew')}}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="walker_id" value="{{$walker->user_id}}">
                            <p class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-search-location"></i> Pedir paseo</button>
                            </p>
                        </form>
                    @elseif($routes ==0) 
                        <p class="text-center">
                            <a type="button" class="btn btn-primary " href="{{ route('walk.create') }}"><i class="fas fa-plus-square"></i>Pedir servicio de paseo</a> 
                        </p>
                    @endif 
                </div>
            </div>  
        @endforeach 
        </div>
    </div>
@endsection
