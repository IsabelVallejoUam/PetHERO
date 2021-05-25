@extends('layouts.app')

@section('content')

<div>
    <div class="mx-auto pull-right">
        <div class="container" style="display:inline-block; color:black;">
            <form action="{{ route('store.indexAll') }}" method="GET" role="search">

                <div class="input-group">
                    <span class="input-group-btn mr-5 mt-1">
                        <button class="btn btn-info" type="submit" title="Buscar Tiendas">
                            <span class="fas fa-search"></span>
                        </button>
                    </span>
                    <input type="text" class="form-control mr-2" name="term" placeholder="Buscar Tiendas" id="term">
                   
                </div>
            </form>
        </div>
    </div>
</div>


<div class="card container"> 
    <a type="button" class="btn btn-secondary mb-4 mt-2" href="{{ url()->previous() }}"><i class="far fa-hand-point-left"></i> Volver</a>

    <h1>
        Establecimientos
    </h1> 
    <div class="container">
    @foreach ($stores as $store)
        <div class="card" style = "width: 20rem; margin:10px; display:inline-block;">
            <img class="card-img-top" src="/uploads/stores/{{$store->photo}}" alt="">
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
</div>
@endsection