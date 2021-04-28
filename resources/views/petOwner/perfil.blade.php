<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DUEÑO DE MASCOTA: {{ $user->name }} {{ $user->lastname }}</title>
    
</head>

<body>

    @extends('layouts.app')
    @section('content')

        <div class="jumbotron col-lg-6 col-md-6 col-sm-6 col-xs-6 offset-3 float-md-center text-center" style=" width:500px;">

            <h1>Perfil de {{ $user->name }}</h1>
            <p>
            <img class="col-lg-6 col-md-6 col-sm-6 col-xs-6 offset-3 float-md-center" src="/images/{{$user->profile_photo}}" style="width:150px; height150px;  border-radius:50%; display: block;">
            </p>
            <div class="container">
                <br>
                <p class="text-center" style="margin-bottom: 20px">PUNTAJE {{$petOwner->score}} </p>
                <br>
                <p class="text-center" style="margin-bottom: 20px">NOMBRE DEL DUEÑO: {{$user->name. ' ' .$user->lastname }} </p>
                <br>
                <p class="text-center" style="margin-bottom: 20px">NUMERO DE CONTACTO: {{$user->phone}}</p>
                <br>
                <p class="text-center" style="margin-bottom: 20px">CORREO DE CONTACTO: {{$user->email}}</p>
                <br>
                <p class="text-center" style="margin-bottom: 20px">DIRECCION: {{$petOwner->address}} </p>
                <br>
                <br>
                <p class="text-center" style="margin-bottom: 20px">MASCOTAS: aqui mascotas con botones para verlas </p>
                <br>
            </div>

        </div>


    @endsection

</body>

</html>
