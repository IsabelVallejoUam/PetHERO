
@extends('layouts.app')

@section('content')

<div class="card container"> <h1>Mascotas Favoritas</h1> 
  
    @foreach ($pets as $pet)
    <div class="card" style="width: 18rem; display:inline-block; margin:10px;">
        <img class="card-img-top" src="/uploads/pets/{{$pet->photo}}">
        <div class="card-body">
            <h4 class="card-title"><b>{{$pet->name}}</b></h4>
            <h5> <i>{{$pet->species}}</i></h5>
            <h6> {{$pet->commentary}}</h6>
            <p><b>Edad:</b> {{$pet->age}}</p>
            <p><b>Raza:</b> {{$pet->race}}</p>
            <p><b>Tamaño:</b> {{$pet->size}}</p>
            <p><b>Sexo:</b> {{$pet->sex}}</p>
            <p><b>Personalidad:</b> {{$pet->personality}}</p>
            <a href="{{ route('store.showPublic', $pet->id) }}" class=" btn btn-info"> Ver {{$pet->name}}</a>
        </div>
    </div>
@endforeach
</div>
@endsection
