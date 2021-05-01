@extends('layouts.app')

@section('content')

<div class="jumbotron"> <h1>Mascotas <a href="{{ route('pet.create') }}" class=" btn btn-info"> Crear Mascota</a></h1> 
    <div>
        <a type="button" class="btn btn-secondary mb-4 mt-2" href="{{ url()->previous() }}"><i class="far fa-hand-point-left"></i> Volver</a>
    </div>
    @foreach ($pets as $pet)
    <div class="card" style="width: 18rem; display:inline-block; margin:10px;">
        <img class="card-img-top" src="/uploads/pets/{{$pet->photo}}">
        <div class="card-body">
            <h4 class="card-title"><b>{{$pet->name}}</b></h4>
            <p><b>Nombre:</b> {{$pet->name}}</p>
            <p><b>Especie:</b> {{$pet->species}}</p>
            <p><b>Raza:</b> {{$pet->race}}</p>
            <p><b>Genero:</b> {{$pet->sex}}</p>
            <p><b>Edad:</b> {{$pet->age}}</p>
            <p><b>Personalidad:</b> {{$pet->personality}}</p>
            <p><b>Comentarios:</b> {{$pet->commentary}}</p>
            <p><b>Tamaño:</b> {{$pet->size}}</p>
            <a href="{{ route('pet.show', $pet->id) }}" class=" btn btn-info"> Ver {{$pet->name}}</a>
        </div>
    </div>
    @endforeach
</div>
@endsection