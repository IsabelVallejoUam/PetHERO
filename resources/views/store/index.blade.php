@extends('layouts.app')

@section('content')
<?php
    $authenticated = false;
    if (Auth::id() == $store->owner_id){ //Verifica que el usuario sea el mismo dueño de la tienda
        $authenticated = true;
    } else {
        $authenticated = false;
    }
?>
<div class="card container">
    <a type="button" class="btn btn-secondary mb-4 mt-2" href="{{ url()->previous() }}"><i class="far fa-hand-point-left"></i> Volver</a>
   
    <h1>{{ $store->store_name }}</h1>
    <img src="/uploads/stores/{{$store->photo}}" style="width:150px; border-radious:50%; display: block;"/>
    <table class="table table-striped table-hover">
        <tr>
            <th scope="col" style="width: 200px">Slogan</th>
            <td><i>"{{$store->slogan}}"</i></td>
        </tr>
        <tr>
            <th scope="col" style="width: 200px">Nit </th>
            <td>{{$store->nit}}<br>
            </td>
        </tr>
        <tr>
            <th scope="col" style="width: 200px">Descripción </th>
            <td>{{$store->description}}<br>
            </td>
        </tr>
        <tr>
            <th scope="col" style="width: 200px">Horario </th>
            <td>{{$store->schedule}}<br>
            </td>
        </tr>
        <tr>
            <th scope="col" style="width: 200px">Dirección </th>
            <td>{{$store->address}}<br>
            </td>
        </tr>
        <tr>
            <th scope="col" style="width: 200px">Teléfono </th>
            <td>{{$store->phone_number}}<br>
            </td>
        </tr>
        <tr>
            <th scope="col" style="width: 200px">Puntuación </th>
            <td>{{$store->score}}<br>
            </td>
        </tr>
    </table>

    {{-- @if($authenticated) --}}
    <form action="{{ route('petOwner.addFavoriteStore', $store->id) }}" method="post"
        onsubmit="return confirm('¿Seguro quieres agregar a {{$store->name}} como tienda favorita?')">
        @csrf
        @method('post')
        <button type="submit" class="btn btn-danger" title="Remover"><i class="fas fa-star"></i></button>
    </form>
    {{-- @endif --}}

    <div class="jumbotron"> <h1>Productos</h1> 
        @foreach ($products as $product)
        <div class="card" style="width: 18rem; display:inline-block; margin:10px;">
            <img class="card-img-top" src="/uploads/products/{{$product->photo}}" alt="Card image cap">
            <div class="card-body">
                <h4 class="card-title"><b>{{$product->name}}</b></h4>
                <h5> <i>{{$product->price}}</i></h5>
                <h6> {{$store->description}}</h6>
                <p><b>Descuento:</b> {{$product->discount}}</p>
                <p><b>Stock:</b> {{$product->quantity}}</p>
                <p><b>Puntuación:</b> {{$product->score}}</p>         
            
                <a href="{{ route('product.show', $product->id) }}" class=" btn btn-info"> Ver {{$product->name}}</a>
            </div>
        </div>   
    @endforeach
    {{$products->links()}}
    </div>

    <div class="jumbotron"> <h1>Servicios</h1> 
        @foreach ($services as $product)
        <div class="card" style="width: 18rem; display:inline-block; margin:10px;">
            <img class="card-img-top" src="/uploads/products/{{$product->photo}}" alt="Card image cap">
            <div class="card-body">
                <h4 class="card-title"><b>{{$product->name}}</b></h4>
                <h5> <i>{{$product->price}}</i></h5>
                <h6> {{$store->description}}</h6>
                <p><b>Descuento:</b> {{$product->discount}}</p>
                <p><b>Puntuación:</b> {{$product->score}}</p>
                
                <a href="{{ route('product.show', $product->id) }}" class=" btn btn-info"> Ver {{$product->name}}</a>
            </div>
            
        </div>
        
    @endforeach
    {{$services->links()}}
    </div>
</div>
@endsection 