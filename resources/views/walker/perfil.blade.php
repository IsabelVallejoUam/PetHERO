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
    <h3> {{$walker->slogan}} </h3>

        <div class="jumbotron col-lg-6 col-md-6 col-sm-6 col-xs-6 offset-3 float-md-center text-center" style=" width:500px;">

            <h1>Perfil de {{ $user->name }}</h1>
            <p>
            <img class="col-lg-6 col-md-6 col-sm-6 col-xs-6 offset-3 float-md-center" src="/images/{{$user->profile_photo}}" style="width:150px; height150px;  border-radius:50%; display: block;">
            </p>
            <div class="container">
                <br>
                <p class="text-center" style="margin-bottom: 20px">PUNTAJE: {{$walker->score}} </p>
                <br>
                <p class="text-center" style="margin-bottom: 20px">NOMBRE DEL PASEADOR: {{$user->name. ' ' .$user->lastname }} </p>
                <br>
                <p class="text-center" style="margin-bottom: 20px">AÑOS DE EXPERIENCIA: {{$walker->experience}} </p>
                <br>
                <br>
                <p class="text-center" style="margin-bottom: 20px">TARIFA: {{$walker->rate}} </p>
                <br>
                <br>
                <p class="text-center" style="margin-bottom: 20px">HORARIO: {{$walker->schedule}} </p>
                <br>
            </div>

            <form action="{{ route('petOwner.addFavoriteWalker', $walker->user_id) }}" method="post"
                onsubmit="return confirm('¿Seguro quieres agregar a {{$user->name. ' ' .$user->lastname }} como paseador favorito?')">
                @csrf
                @method('post')
                <button type="submit" class="btn btn-danger" title="Remover"><i class="fas fa-star"></i></button>
            </form>

        </div>

        

    @endsection

</body>

</html>
