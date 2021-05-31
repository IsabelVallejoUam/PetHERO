@extends('layouts.app')

@section('content')
<div class="card container">

            @if(count(Cart::getContent()))
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <h1>Facturación</h1>
                        </tr>
                        <tr>
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
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>
                                Total compra:
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
                    <form action="{{route('billProduct.createProducts')}}" method="POST">
                        @csrf
                        <input type="hidden" name="bill_id" value="{{$id}}" id="bill_id"><br>
                        <input type="submit" name="btn" class="btn btn-success" value="Generar Factura">
                    </form>
                </div>
            @endif

</div>
@endsection 