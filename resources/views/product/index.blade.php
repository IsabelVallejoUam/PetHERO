@extends('layouts.app')

@section('content')

<div>
    <div class="mx-auto pull-right">
        <div class="container" style="display:inline-block; color:black;">
            <form action="{{ route('product.index') }}" method="GET" role="search">

                <div class="input-group">
                    <span class="input-group-btn mr-5 mt-1">
                        <button class="btn btn-info" type="submit" title="Buscar Productos">
                            <span class="fas fa-search"></span>
                        </button>
                    </span>
                    <input type="text" class="form-control mr-2" name="term" placeholder="Buscar Productos" id="term">
                   
                </div>
            </form>
        </div>
    </div>
</div>


<div class="card container"> 
    <a type="button" class="btn btn-secondary mb-4 mt-2" href="{{ url()->previous() }}"><i class="far fa-hand-point-left"></i> Volver</a>

    <h1>
        Productos
    </h1> 
    <div class="container">
    @foreach ($products as $product)
        <div class="card" style = "width: 20rem; margin:10px; display:inline-block;">
            <img class="card-img-top" src="/uploads/products/{{$product->photo}}" alt="{{$product->name}}">
            <div class="card-body">
                <h4 class="card-title"><b>{{$product->name}}</b></h4>
                <h5> <i>{{$product->price}}</i></h5>
                <h6> {{$product->description}}</h6>
                <p><b>Tipo: </b>{{$product->type}}</p>
                <p><b>Descuento:</b> {{$product->discount}}</p>
                <p><b>Descripcion:</b> {{$product->description}}</p>
                <p><b>Puntuación:</b> {{$product->score}}</p>
                <a href="{{ route('product.show', $product->id) }}" class=" btn btn-info"> Ver {{$product->name}}</a>
            </div>
        </div>
    @endforeach
    </div>
</div>
@endsection

