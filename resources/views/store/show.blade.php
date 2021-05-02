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
<div class="container">
    <a type="button" class="btn btn-secondary mb-4 mt-2" href="{{ route('store.index') }}">Volver</a>
    
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
    
    <form action="{{ route('petOwner.addFavoriteStore', $store->id) }}" method="post"
        onsubmit="return confirm('¿Seguro quieres agregar a {{$store->name}} como tienda favorita?')">
        @csrf
        @method('post')
        <button type="submit" class="btn btn-danger" title="Remover"><i class="fas fa-star"></i></button>
    </form>

    <div class="jumbotron"> <h1>Productos</h1> 
        @foreach ($products as $product)
        <div class="card" style="width: 18rem; display:inline-block; margin:10px;">
            <img class="card-img-top" src="/uploads/products/{{$product->photo}}" alt="Card image cap">
            <div class="card-body">
                <h4 class="card-title"><b>{{$product->name}}</b>
                    @if ($product->privacy == 'private')
                        <i class="fas fa-lock"></i>
                    @else
                        <i class="fas fa-lock-open"></i>
                    @endif
                </h4>
                <h5> <i>{{$product->price}}</i></h5>
                <h6> {{$store->description}}</h6>
                <p><b>Descuento:</b> {{$product->discount}}</p>
                <p><b>Stock:</b> {{$product->quantity}}</p>
                <p><b>Puntuación:</b> {{$product->score}}</p>         
            
                <a href="{{ route('product.show', $product->id) }}" class=" btn btn-info"> Ver {{$product->name}}</a>
                @if($authenticated)
                <a href="{{ route('product.edit', ['product' => $product->id]) }}" class="btn btn-warning" title="Editar"><i class="far fa-edit"></i>Editar{{$product->name}}</a>
                <form action="{{ route('product.destroy', $product->id) }}" method="post"
                    onsubmit="return confirm('¿Esta seguro que desea remover esta tienda?')">
                    @csrf
                    @method('delete')
                    <button type="submit" class=" btn btn-danger">Eliminar</button>
                </form>
                @endif
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
                <h4 class="card-title"><b>{{$product->name}}</b>
                    @if ($product->privacy == 'private')
                        <i class="fas fa-lock"></i>
                    @else
                        <i class="fas fa-lock-open"></i>
                    @endif
                </h4>
                <h5> <i>{{$product->price}}</i></h5>
                <h6> {{$store->description}}</h6>
                <p><b>Descuento:</b> {{$product->discount}}</p>
                <p><b>Puntuación:</b> {{$product->score}}</p>
                
                <a href="{{ route('product.show', $product->id) }}" class=" btn btn-info"> Ver {{$product->name}}</a>
                @if($authenticated)
                <a href="{{ route('product.edit', ['product' => $product->id]) }}" class="btn btn-warning" title="Editar"><i class="far fa-edit"></i>Editar{{$product->name}}</a>
                <form action="{{ route('product.destroy', $product->id) }}" method="post"
                    onsubmit="return confirm('¿Esta seguro que desea remover esta tienda?')">
                    @csrf
                    @method('delete')
                    <button type="submit" class=" btn btn-danger">Eliminar</button>
                </form>
                @endif
            </div>
            
        </div>
        
    @endforeach
    {{$services->links()}}
    
    </div>
    {{-- Envío del id de la tienda del view al controlador de producto --}}
    @if($authenticated)
    <form action="{{route('product.getData')}}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="store_id" value="{{$store->id}}">
        <button type="submit" class="btn btn-primary">Añadir producto ó servicio</button>
    </form>
    @endif

    <div class="btn-group" role="group" aria-label="Link options">
        <form action="{{ route('store.destroy', $store->id) }}" method="post"
            onsubmit="return confirm('¿Esta seguro que desea remover este establecimiento?')">
            @csrf
            @method('delete')
            @if($authenticated)
                <button type="submit" class="btn btn-danger" title="Remover">Eliminar</button>
            @endif  
        </form>
    </div>
</div>
@endsection 