@extends('layouts.app')

@section('content')
<div class="card container">
    <div>
        <a type="button" class="btn btn-secondary mb-4 mt-2" href="{{ url()->previous() }}"><i class="far fa-hand-point-left"></i> Volver</a>
    </div>
    {{$bills->links()}}
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <h1>
                    Facturas
                </h1>
            </tr>
            <tr>
                <th scope="col">
                    Fecha
                </th>
                <th scope="col">
                    Precio total
                </th>
                <th scope="col">
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bills as $item)
                <tr>
                    <th>
                        {{$item->created_at}}
                    </th>
                    <th>
                        {{$item->total_price}}
                    </th>
                    <th>
                        <a href="{{ route('bill.show', $item->id) }}" class=" btn btn-info"> Ver Factura</a>
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 