@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        {{-- <a type="button" class="btn btn-secondary mb-4 mt-2" href="{{ route('pet.walkerIndex') }}"><i class="far fa-hand-point-left"></i> Volver</a> --}}
        <div>
            <a type="button" class="btn btn-secondary mb-4 mt-2" href="{{ url()->previous() }}"><i class="far fa-hand-point-left"></i> Volver</a>
        </div>
        
        {{$billProducts->links()}}
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>
                        <h1>{{ $bill->created_at }}</h1>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>
                        <h2>Lista de Productos:</h2>
                    </th>
                </tr>
                @foreach ($billProducts as $item)
                    <tr class="col-lg-12 row justify-content-center">
                        <th><h4>Producto</h4></th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th scope="col">Nombre producto</th>
                        <th>{{$item->name}}</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th scope="col">Cantidad</th>
                        <th>{{$item->quantity}}</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th scope="col">Precio</th>
                        <th>{{$item->price}} $</th>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th><h1>Precio Total:</h1></th>
                    <th><h1>{{$bill->total_price}} $</h1></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection