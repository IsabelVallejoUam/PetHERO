@extends('layouts.app')

@section('content')
<div class="container">
    <a type="button" class="btn btn-secondary mb-4 mt-2" href="{{ url()->previous() }}"><i class="far fa-hand-point-left"></i> Volver</a>
    
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
@endsection 