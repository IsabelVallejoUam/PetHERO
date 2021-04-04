
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ver Datos de Perfil</h1>
    <a type="button" class="btn btn-secondary mb-4 mt-2" href="{{ url()->previous() }}"><i class="far fa-hand-point-left"></i> Volver</a>
    <table class="table table-striped table-hover">
        <tr>
            <th scope="col">Full Name</th>
            <td>{{ $walker->owner->name. ' ' .$walker->owner->lastname  }}</td>
        </tr>
        <tr>
            <th scope="col">Email</th>
            <td>{{ $walker->owner->email }}</td>
        </tr>
        <tr>
            <th scope="col">Phone Number</th>
            <td>{{ $walker->owner->phone }}</td>
        </tr>
        <tr>
            <th scope="col">Document</th>
            <td>{{ $walker->owner->document }}</td>
        </tr>
        <tr>
            <th scope="col">Experience</th>
            <td>{{ $walker->experience }}</td>
        </tr>
        <tr>
            <th scope="col">Creado en</th>
            <td>{{ $walker->created_at ?? "Desconocida" }}</td>
        </tr>
        <tr>
            <th scope="col">Actualizado en</th>
            <td>{{ $walker->updated_at ?? "Desconocida"  }}</td>
        </tr>
    </table>

    <div class="btn-group" role="group" aria-label="Link options">
        <a href="{{ route('walker.edit', auth()->user()->document) }}" class="btn btn-warning" title="Editar"><i class="far fa-edit"></i></a>
        <form action="{{ route('walker.destroy', auth()->user()->document) }}" method="post"
            onsubmit="return confirm('¿Esta seguro que desea eliminar el perfil?')">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger" title="Remover"><i class="fas fa-trash"></i></button>
        </form>
    </div>
</div>
@endsection