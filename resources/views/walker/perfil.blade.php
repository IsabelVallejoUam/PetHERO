<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PASEADOR: {{ $user->name }} {{ $user->lastname }}</title>
    
</head>

<body>
    @extends('layouts.app')
    @section('content')
    <a type="button" class="btn btn-secondary mb-4 mt-2" href="{{ route('walker.index') }}">Volver</a>
        <div class="card container align-middle" style="width:400px;"> 
            <h1>Perfil de {{ $user->name }}</h1>
            <h3> "{{$walker->slogan}}" </h3>
            <p>
                <img src="/uploads/avatars/{{$user->avatar}}" style="width:150px; border-radious:50%; display: block; margin-left: auto; margin-right: auto;"/>
            </p>
            <div class="container">
                <br>
                <p class="text-center" style="margin-bottom: 20px">PUNTAJE: {{$walker->score}} </p>
                <br>
                <p class="text-center" style="margin-bottom: 20px">NOMBRE DEL PASEADOR: {{$user->name. ' ' .$user->lastname }} </p>
                <br>
                <p class="text-center" style="margin-bottom: 20px">AÑOS DE EXPERIENCIA: {{$walker->experience}} </p>
                <br>
            </div>
            <div class="col text-center">
                <form action="{{ route('petOwner.addFavoriteWalker', $walker->user_id) }}" method="post"
                    onsubmit="return confirm('¿Seguro quieres agregar a {{$user->name. ' ' .$user->lastname }} como paseador favorito?')">
                    @csrf
                    @method('post')
                    <button type="submit" class="btn btn-danger text-center " title="favorito"><i class="fas fa-star"></i></button>
                </form>
            </div>
        </div>
    @endsection
</body>
</html>
