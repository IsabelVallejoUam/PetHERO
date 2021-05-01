@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar perfil de {{$user->name}}</h1>
    <a type="button" class="btn btn-secondary mb-4 mt-2" href="{{ url()->previous() }}"><i class="far fa-hand-point-left"></i> Volver</a>
    <form action="{{ route('storeOwner.update',$user->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        @include('storeOwner.sub_form')
        <button type="submit" class="btn btn-primary">Editar</button>
    </form>
</div>
@endsection

