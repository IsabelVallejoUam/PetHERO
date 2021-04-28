@extends('layouts.app')

@section('content')
<div class="container">
    <a type="button" class="btn btn-secondary mb-4 mt-2" href="{{ url()->previous() }}">Volver</a>
    
    <h1>{{ $store->store_name }}</h1>
    <img src="/uploads/stores/{{$store->photo}}" style="width:150px; border-radious:50%; display: block;"/>
    <table class="table table-striped table-hover">
        <tr>
            <th scope="col" style="width: 200px">Slogan</th>
            <td><i>"{{$store->slogan}}"</i></td>
        </tr>
        <tr>
            <th scope="col" style="width: 200px">Nit </th>
            <td>{{$store->nit}}<br>
            </td>
        </tr>
        <tr>
            <th scope="col" style="width: 200px">Descripción </th>
            <td>{{$store->description}}<br>
            </td>
        </tr>
        <tr>
            <th scope="col" style="width: 200px">Horario </th>
            <td>{{$store->schedule}}<br>
            </td>
        </tr>
        <tr>
            <th scope="col" style="width: 200px">Dirección </th>
            <td>{{$store->address}}<br>
            </td>
        </tr>
        <tr>
            <th scope="col" style="width: 200px">Teléfono </th>
            <td>{{$store->phone_number}}<br>
            </td>
        </tr>
        <tr>
            <th scope="col" style="width: 200px">Puntuación </th>
            <td>{{$store->score}}<br>
            </td>
        </tr>
    </table>
    <div class="btn-group" role="group" aria-label="Link options">
        <form action="{{ route('store.destroy', $store->id) }}" method="post"
            onsubmit="return confirm('¿Esta seguro que desea remover este establecimiento?')">
            @csrf
            @method('delete')
            <?php
                $authenticated = false;
                use Illuminate\Support\Facades\Auth;
                if (Auth::id() == $store->owner_id){ //Verifica que el usuario sea el mismo dueño del post
                    $authenticated = true;
                } else {
                    $authenticated = false;
                }
            ?>
            @if($authenticated)
                <button type="submit" class="btn btn-danger" title="Remover">Eliminar</button>
            @endif  
        </form>
    </div>
</div>
@endsection 