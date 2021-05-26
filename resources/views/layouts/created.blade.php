@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <a>
            <h1 style="position:static; display:block; margin-left:auto; margin-right:auto;" class="p-1 text-center">Perfil de {{ $user->name. ' ' .$user->lastname  }}  (Dueño de Tiendas)</h1>
            <img src="/uploads/avatars/{{$user->avatar}}" style="width:150px; border-radious:50%; display: block; margin-left: auto; margin-right: auto;"/><br>
        </a>
        <table class="table table-striped table-hover">
            <tr>
                <th scope="col">Nombre Completo</th>
                <td>{{ $user->name. ' ' .$user->lastname  }}</td>
            </tr>
            <tr>
                <th scope="col">Correo Electrónico</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th scope="col">Número de Teléfono</th>
                <td>{{ $user->phone }}</td>
            </tr>
        </table>
        
        <div class="card"> <h1>Todo listo, solo inicia sesión</h1> 
            Inicia sesión para modificar tus datos.
            <a type="button" class="btn btn-secondary mb-4 mt-2" style="width:200px;" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Inicia sesión</a>
        </div>
    </div>
</div>

@endsection