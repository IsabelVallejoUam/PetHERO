@extends('layouts.app')

@section('content')
<?php
    use App\Models\PetOwner;
    $type = '';
    $pet = PetOwner::find(Auth::id());
    if (isset($pet)) {
        $type = 'petOwner';
    } 
    
    $reviewCount = App\Models\Review::where('user_id',Auth::id())->where('type','product')->where('product_id',$product->id)->count();
    $rate = \App\Models\Review::where('type','product')->where('product_id',$product->id)->avg('rate');
?>
<div class="card container">
    
    <div>
        <a type="button" class="btn btn-secondary mb-4 mt-2" href="{{ url()->previous() }}"><i class="far fa-hand-point-left"></i> Volver</a>
    </div>
    <a>
        <h1 style="position:static; display:block; margin-left:auto; margin-right:auto;" class="p-1 text-center">{{ $product->name}}</h1>
        <img src="/uploads/products/{{$product->photo}}" style="width:150px; border-radious:50%; display: block; margin-left: auto; margin-right: auto;"/>
    </a>
     <table class="table table-striped table-hover">
        <tr>
            <th scope="col">Nombre del producto</th>
            <td>{{ $product->name}}</td>
        </tr>
        <tr>
            <th scope="col">Precio</th>
            <td>{{ $product->price }}</td>
        </tr>
        <tr>
            <th scope="col">Descripción</th>
            <td>{{ $product->description }}</td>
        </tr>
        <tr>
            <th scope="col">Descuento</th>
            <td>{{ $product->discount }}</td>
        </tr>
        <tr>
            <th scope="col">Calificación</th>
            @if ($rate != null)
                <td>{{$rate}}/5<br>
            @else
                <td>Este producto o servicio aún no cuenta con calificaciones<br>
            @endif
        </tr>  
    </table>
    @if($reviewCount < 1)
        <form action="{{route('review.makeReview')}}" method="POST" 
        onsubmit="return confirm('¿Está seguro que desea calificar este producto o servicio?')">
            {{ csrf_field() }}
            <input type="hidden" name="product_id" value="{{$product->id}}" id="product_id">
            <input type="hidden" name="type" value="product" id="type">
            <input type="hidden" name="store_id" value="{{$product->store_id}}" id="store_id">
            <button type="submit" class="btn btn-primary">Calificar producto ó servicio</button>
        </form>
    @else
        ¡Ya calificaste este producto!
    @endif
@endsection