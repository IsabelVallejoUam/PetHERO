@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear una nueva tienda</h1>
    <a type="button" class="btn btn-secondary mb-4 mt-2" href="{{ url()->previous() }}"><i class="far fa-hand-point-left"></i> Volver</a>
    <form action="{{ route('store.store') }}" method="post">
        @csrf
        @include('store.sub_form')
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
</div>
@endsection