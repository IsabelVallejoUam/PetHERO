@extends('layouts.app')

@section('content')
<div class="card container">
    <h1>Editar Mascota</h1>
    <a type="button" class="btn btn-secondary mb-4 mt-2" href="{{ url()->previous() }}"><i class="far fa-hand-point-left"></i> Volver</a>
    <form action="{{ route('pet.update',$pet->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        @include('pet.sub_form')
        <button type="submit" class="btn btn-primary">Editar</button>
    </form>
    <p>
        <form action="{{ route('pet.destroy', $pet) }}" method="post"
                    onsubmit="return confirm('¿Esta seguro que desea eliminar la Mascota?')">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger" title="Remover{{$pet->name}}"><i class="fas fa-trash"></i></button>
                </form>
</div>

@endsection
