@extends('layouts.app')

@section('content')

<div class="jumbotron"> <h1>Establecimientos Favoritos</h1> 
  
    @foreach ($stores as $store)
    <div class="card" style="width: 18rem; display:inline-block; margin:10px;">
        <img class="card-img-top" src="/uploads/stores/{{$store->photo}}" alt="{{$store->description}}">
        <div class="card-body">
            <h4 class="card-title"><b>{{$store->store_name}}</b></h4>
            <h5> <i>{{$store->slogan}}</i></h5>
            <h6> {{$store->description}}</h6>
            <p><b>Horario:</b> {{$store->schedule}}</p>
            <p><b>Dirección:</b> {{$store->address}}</p>
            <p><b>Teléfono:</b> {{$store->phone_number}}</p>
            <p><b>Puntuación:</b> {{$store->score}}</p>
            <a href="{{ route('store.showPublic', $store->id) }}" class=" btn btn-info"> Ver {{$store->store_name}}</a>
        </div>
    </div>
@endforeach
</div>
@endsection