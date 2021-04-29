@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Añadir un nuevo producto</h1>
    <a type="button" class="btn btn-secondary mb-4 mt-2" href="{{ url()->previous() }}"><i class="far fa-hand-point-left"></i> Volver</a>
    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('product.sub_form')
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
</div>


@endsection