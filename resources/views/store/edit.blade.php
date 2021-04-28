@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar establecimiento</h1>
    <a type="button" class="btn btn-secondary mb-4 mt-2" href="{{ url()->previous() }}"><i class="far fa-hand-point-left"></i> Volver</a>
    <form action="{{ route('store.update',$store->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        @include('store.sub_form')
        <button type="submit" class="btn btn-primary">Editar</button>
    </form>
</div>
@endsection
