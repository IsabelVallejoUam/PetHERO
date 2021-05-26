@extends('layouts.app')

@section('content')
<?php
 use App\Models\Walker;
    $type = '';
    $walker = Walker::find(Auth::id());
    if (isset($walker)) {
        $type = 'walker';
    } 
?>
<div class="container">
    <div class="card">
        {{-- <a type="button" class="btn btn-secondary mb-4 mt-2" href="{{ route('pet.walkerIndex') }}"><i class="far fa-hand-point-left"></i> Volver</a> --}}
        
        <h1>{{ $pet->pet_name }}</h1>
        <img src="/uploads/pets/{{$pet->photo}}" style="width:150px; border-radious:50%; display: block;"/>
        <table class="table table-striped table-hover">
            <tr>
                <th scope="col" style="width: 200px">Nombre</th>
                <td>{{$pet->name}}</td>
            </tr>
            <tr>
                <th scope="col" style="width: 200px">Especie</th>
                <td>{{$pet->species}}<br>
                </td>
            </tr>
            <tr>
                <th scope="col" style="width: 200px">Raza</th>
                <td>{{$pet->race}}<br>
                </td>
            </tr>
            <tr>
                <th scope="col" style="width: 200px">Sexo</th>
                <td>{{$pet->sex}}<br>
                </td>
            </tr>
            <tr>
                <th scope="col" style="width: 200px">Edad</th>
                <td>{{$pet->age}}<br>
                </td>
            </tr>
            <tr>
                <th scope="col" style="width: 200px">Personalidad</th>
                <td>{{$pet->personality}}<br>
                </td>
            </tr>
            <tr>
                <th scope="col" style="width: 200px">Comentario del dueño</th>
                <td>{{$pet->commentary}}<br>
                </td>
            </tr>
            <tr>
                <th scope="col" style="width: 200px">Tamaño</th>
                <td>{{$pet->size}}<br>
                </td>
            </tr>
        </table>
    </div>

    @if ($type == 'walker')
    <div class="col text-center">
        <form action="{{ route('walker.addFavoritePet', ['pet' => $pet->id]) }}" method="post"
            onsubmit="return confirm('¿Seguro quieres agregar a {{$pet->name }} como mascota favorita?')">
            @csrf
            @method('post')
            <button type="submit" class="btn btn-danger text-center " title="favorito"><i class="fas fa-star"></i>Añadir a favoritos</button>
        </form>
    </div>

    <div class="col text-center">
        <form action="{{ route('favoritePet.destroy', ['favoritePet' => $pet->id]) }}" method="post"
            onsubmit="return confirm('¿Seguro quieres eliminar a {{$pet->name }} como mascota favorita?')">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger " title="Remover"><i class="fas fa-trash"></i>Eliminar de favoritos</button>
        </form>
    </div>


    @endif
    
</div>
@endsection 