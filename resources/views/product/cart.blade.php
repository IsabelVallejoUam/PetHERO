@extends('layouts.app')

@section('content')
<div class="card container">
    <div>
        <a type="button" class="btn btn-secondary mb-4 mt-2" href="{{ url()->previous() }}"><i class="far fa-hand-point-left"></i> Volver</a>
    </div>
            @if(count(Cart::getContent()))
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <h1>Carrito de Compras</h1>
                        </tr>
                        <tr>
                            <th scope="col">
                                ID
                            </th>
                            <th scope="col">
                                Nombre producto
                            </th>
                            <th scope="col">
                                Cantidad
                            </th>
                            <th scope="col">
                                Precio
                            </th>
                            <th scope="col">
                                Subtotal
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (Cart::getContent() as $item)
                            <tr>
                                <th>
                                    {{$item->id}}
                                </th>
                                <th>
                                    {{$item->name}}
                                </th>
                                <th>
                                    {{$item->quantity}}
                                </th>
                                <th>
                                    {{$item->price}} $
                                </th>
                                <th>
                                    {{$item->quantity * $item->price}} $
                                </th>
                                <th>
                                    <form action="{{route('cart.removeItem')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$item->id}}">
                                        <button type="submit" class="btn btn-link btn-sm text-danger">Eliminar</button>
                                    </form>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>
                                Total carrito:
                            </th>
                            <?php
                                $total = 0;
                                foreach (Cart::getContent() as $item) {
                                    $total += $item->quantity * $item->price;
                                }
                            ?>
                            <th>
                                {{$total}} $
                            </th>
                        </tr>
                    </tfoot>
                </table>
                <div class="col-lg-12 row justify-content-center">
                    <form action="{{route('bill.store')}}" method="POST" class="center">
                        @csrf
                        <input type="submit" name="btn" class="btn btn-success" value="Ir a Pagar">
                    </form>
                    <form action="{{route('cart.clear')}}" method="GET" class="center">
                        @csrf
                        <input type="submit" name="btn" class="btn btn-danger" value="Vaciar Carrito">
                    </form>
                </div>
            @else
                <h3>Tu Carrito esta vacio!!</h3>
            @endif

</div>
@endsection 