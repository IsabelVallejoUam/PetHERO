<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PASEADOR: {{ $user->name }} {{ $user->lastname }}</title>
    
</head>

<body>
<?php
    use App\Models\PetOwner;
    $type = '';
    $pet = PetOwner::find(Auth::id());
    if (isset($pet)) {
        $type = 'petOwner';
    } 
    $routes_count = \App\Models\Route::where('owner_id',$user->id)->count();
?>
    @extends('layouts.app')
    @section('content')
      <div class="card container align-middle" style="width:600px;"> 
        <a type="button" class="btn btn-secondary mb-4 mt-2" style="width: 100px" href="{{ url()->previous() }}">Volver</a>
            <h1 class="text-center">Perfil de {{ $user->name }}</h1>
            <p>
                <img src="/uploads/avatars/{{$user->avatar}}" style="width:150px; border-radious:50%; display: block; margin-left: auto; margin-right: auto;"/>
            </p>
            <h3 class="text-center"> "{{$walker->slogan}}" </h3>
            <div class="container">
                <br>
                <p class="text-center" style="margin-bottom: 20px">PUNTAJE: {{$walker->score}} </p>
                <br>
                <p class="text-center" style="margin-bottom: 20px">NOMBRE DEL PASEADOR: {{$user->name. ' ' .$user->lastname }} </p>
                <br>
                <p class="text-center" style="margin-bottom: 20px">AÑOS DE EXPERIENCIA: {{$walker->experience}} </p>
                <br>
                <p class="text-center" style="margin-bottom: 20px">NÚMERO DE RUTAS: {{$routes_count}} </p>
                <br>
            </div>
            @if($routes_count > 0)
                <form action="{{route('route.getData')}}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="walker_id" value="{{$user->id}}">
                    <p class="text-center">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search-location"></i> Ver rutas</button>
                    </p>
                </form>
                @if($type =='petOwner')
                    <form action="{{route('walk.requestNew')}}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="walker_id" value="{{$user->id}}">
                        <p class="text-center">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-search-location"></i> Pedir paseo</button>
                        </p>
                    </form>
                @else 
                    <p class="text-center">
                        <a type="button" class="btn btn-primary " href="{{ route('walk.create') }}"><i class="fas fa-plus-square"></i>Pedir servicio de paseo</a> 
                    </p>
                @endif
            @endif

            @if ($type == 'petOwner')
                <div class="col text-center">
                    <form action="{{ route('petOwner.addFavoriteWalker', $walker->user_id) }}" method="post"
                        onsubmit="return confirm('¿Seguro quieres agregar a {{$user->name. ' ' .$user->lastname }} como paseador favorito?')">
                        @csrf
                        @method('post')
                        <button type="submit" class="btn btn-danger text-center " title="favorito"><i class="fas fa-star"></i>Añadir a favoritos</button>
                    </form>
                </div>
            @endif

        </div>
    @endsection
</body>
</html>
