@extends('layouts.app')

@section('content')
<?php
    use App\Models\PetOwner;
    $type = '';
    $pet = PetOwner::find(Auth::id());
    if (isset($pet)) {
        $type = 'petOwner';
    } 
?>

<div class="card container"> 
    <div>
        <a type="button" class="btn btn-secondary mb-4 mt-2" href="{{ url()->previous() }}"><i class="far fa-hand-point-left"></i> Volver</a>
    </div>
    <div class="form-horizontal">
        <div class=" pull-right">
            <div class="container" style="display:inline-block; color:black;">
                <form action="{{ route('product.index') }}" method="GET" role="search">

                    <div class="input-group">
                        <span class="input-group-btn">
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


    <h1>
        Productos
    </h1> 
    <div class="container">
    @foreach ($products as $product)
    <?php
        $rate = \App\Models\Review::where('type','product')->where('product_id',$product->id)->avg('rate');
    ?>  
        <div class="card" style = "width: 20rem; margin:10px; display:inline-block;">
            <img class="card-img-top" src="/uploads/products/{{$product->photo}}" alt="{{$product->name}}">
            <div class="card-body">
                <h4 class="card-title"><b>{{$product->name}}</b></h4>
                <h5> <i>{{$product->price}}</i></h5>
                <h6> {{$product->description}}</h6>
                <p><b>Tipo: </b>{{$product->type}}</p>
                <p><b>Descuento:</b> {{$product->discount}}</p>
                <p><b>Descripcion:</b> {{$product->description}}</p>
                @if ($rate != null)
                    <p><b>Puntuaci??n:</b> {{$rate}}/5</p>
                @else
                    <p><b>A??n no hay calificaciones</p>
                @endif
                <p><b>Stock Disponible:</b> {{$product->quantity}}</p>
                <a href="{{ route('product.show', $product->id) }}" class=" btn btn-info"> Ver {{$product->name}}</a>
                <div>
                    @if ($type == 'petOwner')
                        @if($product->quantity > 0)
                            <form action="{{route('cart.add')}}" method="POST" class="center">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <input type="submit" name="btn" class="btn btn-success" value="Agregar al Carrito">
                            </form>
                        @else
                            ??Este producto no tiene stock!
                        @endif
                    @endif
                </div>
            </div>
        </div>
    @endforeach
    </div>
</div>
@endsection

