@extends('layouts.app')

@section('content')
<div class="card container">
    @php
        use App\Models\User;
        use App\Models\Product;
    @endphp
    <div>
        <a type="button" class="btn btn-secondary mb-4 mt-2" href="{{ url()->previous() }}"><i class="far fa-hand-point-left"></i> Volver</a>
    </div>
    {{$soldProducts->links()}}

    <table class="table table-striped table-hover">
        <thead>
            <tr>  
                <h1>Productos Vendidos</h1>
            </tr>
            <tr>
                <th scope="col">
                    Comprador
                </th>
                <th scope="col">
                    Nombre del producto
                </th>
                <th scope="col">
                    Precio
                </th>
                <th>
                    Fecha
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($soldProducts as $item)
                <?php
                    $pet_owner = User::where('id','=',$item->pet_owner_id)->first();
                    $product= Product::where('id','=',$item->product_id)->first();
                ?>
                <tr>
                    <th>
                        {{$pet_owner->name}}  {{$pet_owner->lastname}}
                    </th>
                    <th>
                        {{$product->name}}
                    </th>
                    <th>
                        {{$product->price}}
                    </th>
                    <th>
                        {{$item->created_at}}
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 