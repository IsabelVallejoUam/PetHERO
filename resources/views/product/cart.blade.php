@extends('layouts.app')

@section('content')
<div class="card container">

            @if(count(Cart::getContent()))
                <table class="table table-striped table-hover">
                    <thead>
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
                                    {{$item->price}}
                                </th>
                                <th>
                                    {{$item->quantity * $item->price}}
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
                                {{$total}}
                            </th>
                        </tr>
                    </tfoot>
                </table>
            @else
                <h3>Tu Carrito esta vacio!!</h3>
            @endif

</div>
@endsection 