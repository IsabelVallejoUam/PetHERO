@extends('layouts.app')

@section('content')
<div class="container">
    <a type="button" class="btn btn-secondary mb-4 mt-2" href="{{ url()->previous() }}"><i class="far fa-hand-point-left"></i> Volver</a>
    <a>
        <h1 style="position:static; display:block; margin-left:auto; margin-right:auto;" class="p-1 text-center">{{ $product->name}}</h1>
        <img src="/uploads/products/{{$product->photo}}" style="width:150px; border-radious:50%; display: block; margin-left: auto; margin-right: auto;"/>
    </a>
     <table class="table table-striped table-hover">
        <tr>
            <th scope="col">{{ $product->name}}</th>
            <td></td>
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
            <td>{{ $product->score }}</td>
        </tr>
    </table>
@endsection