@extends('layouts.app')

@section('content')
<?php
    use App\Models\PetOwner;
    $type = '';
    $pet = PetOwner::find(Auth::id());
    if (isset($pet)) {
        $type = 'petOwner';
    } 
    $reviewCount = App\Models\Review::where('user_id',Auth::id())->where('type','store')->where('store_id',$store->id)->count();
    $rate = \App\Models\Review::where('type','store')->where('store_id',$store->id)->avg('rate');
    $overallCount = App\Models\Review::where('type','store')->where('store_id',$store->id)->count();
    
?>

<div class="card container">
    
    <a type="button" class="btn btn-secondary mb-4 mt-2"  style="width: 100px;" href="{{ route("store.indexAll") }}"><i class="far fa-hand-point-left"></i> Volver</a>
   
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
            <th scope="col" style="width: 200px">Puntuación 
                @if($overallCount > 0)
                    <form action="{{route('review.indexStore')}}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="store_id" value="{{$store->id}}" id="store_id">
                        <button type="submit" style="display:block;" class="btn btn-primary">Ver ({{$overallCount}}) reseñas</button>
                    </form>
                @endif
            </th>
            @if ($rate != null)
                <td>{{$rate}}/5<br>
            @else
                <td>Esta tienda aún no cuenta con calificaciones<br>
            @endif
            </td>
        </tr>
    </table>

    <div class="btn-group" role="group" aria-label="options">
        @if ($type == 'petOwner')
            <form action="{{ route('petOwner.addFavoriteStore', $store->id) }}" method="post"
                onsubmit="return confirm('¿Seguro quieres agregar a {{$store->name}} como tienda favorita?')">
                @csrf
                @method('post')
                <button type="submit" class="btn btn-danger" title="Favorito"><i class="fas fa-star">  Favorito</i></button>
            </form>

            @if($reviewCount == 0 && $type == 'petOwner')
                <form action="{{route('review.makeReview')}}" method="POST" 
                onsubmit="return confirm('¿Está seguro que desea calificar esta tienda?')">
                    {{ csrf_field() }}
                    <input type="hidden" name="store_id" value="{{$store->id}}" id="store_id">
                    <input type="hidden" name="type" value="store" id="type">
                    <button type="submit" class="btn btn-primary">Calificar tienda</button>
                </form>
            @else
                ¡Ya calificaste este establecimiento!
            @endif
        @endif
    </div>


    <div class="container"> <h1>Productos</h1> 
        @foreach ($products as $product)
        <?php
            $productRate = \App\Models\Review::where('type','product')->where('product_id',$product->id)->avg('rate');
        ?>
        <div class="card" style="width: 18rem; display:inline-block; margin:10px;">
            <img class="card-img-top" src="/uploads/products/{{$product->photo}}" alt="Card image cap">
            <div class="card-body">
                <h4 class="card-title"><b>{{$product->name}}</b></h4>
                <h5> <i>{{$product->price}}</i></h5>
                <h6> {{$store->description}}</h6>
                <p><b>Descuento:</b> {{$product->discount}}</p>
                <p><b>Stock:</b> {{$product->quantity}}</p>  
                @if ($productRate != null)
                    <p><b>Puntuación:</b> {{$productRate}}/5</p>
                @else
                    <p><b>Aún no hay calificaciones</p>
                @endif
                <a href="{{ route('product.show', $product->id) }}" class=" btn btn-info"> Ver {{$product->name}}</a>
            </div>
        </div>   
    @endforeach
    {{$products->links()}}
    </div>

    <div class="container"> <h1>Servicios</h1> 
        @foreach ($services as $product)
        <?php
            $productRate = \App\Models\Review::where('type','product')->where('product_id',$product->id)->avg('rate');
        ?>
        <div class="card" style="width: 18rem; display:inline-block; margin:10px;">
            <img class="card-img-top" src="/uploads/products/{{$product->photo}}" alt="Card image cap">
            <div class="card-body">
                <h4 class="card-title"><b>{{$product->name}}</b></h4>
                <h5> <i>{{$product->price}}</i></h5>
                <h6> {{$store->description}}</h6>
                <p><b>Descuento:</b> {{$product->discount}}</p>
                @if ($productRate != null)
                    <p><b>Puntuación:</b> {{$productRate}}/5</p>
                @else
                    <p><b>Aún no hay calificaciones</p>
                @endif
                <a href="{{ route('product.show', $product->id) }}" class=" btn btn-info"> Ver {{$product->name}}</a>
            </div>
        </div>
    @endforeach
    {{$services->links()}}
    </div>
</div>
@endsection 