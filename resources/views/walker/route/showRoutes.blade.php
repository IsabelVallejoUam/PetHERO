@extends('layouts.app')

@section('content')
    <div class="card container">
        <div class="container">
            <a type="button" class="btn btn-secondary mb-4 mt-2" href="{{ url()->previous() }}"><i
                    class="far fa-hand-point-left"></i> Volver</a>
            <a>
                <h1 style="position:static; display:block; margin-left:auto; margin-right:auto;"
                    class="p-1 text-center">Rutas de {{ $user->name . ' ' . $user->lastname }} (Paseador de
                    mascotas) 
                </h1>
                <h3 class="text-center"><i>"{{ $walker->slogan }}"</i>
                </h3>

                <img src="/uploads/avatars/{{ $user->avatar }}"
                    style="width:150px; border-radious:50%; display: block; margin-left: auto; margin-right: auto;" />
            </a>
            <table class="table table-striped table-hover">
                <tr>
                    <th scope="col">Full Name</th>
                    <td>{{ $user->name . ' ' . $user->lastname }}</td>
                </tr>
                <tr>
                    <th scope="col">Email</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th scope="col">Experience</th>
                    <td>{{ $walker->experience }} Años</td>
                </tr>
            </table>
            <h3>Mis rutas</h3>
            {{--Rutas del paseador--}}
            <table class="table table-striped table-hover">
                <tr>
                    <th scope="col">Ruta</th>
                    <th scope="col">Descripción de la ruta</th>
                    <th scope="col">Duración aproximada</th>
                    <th scope="col">Precio por paseo</th>
                    <th scope="col">Horario</th>
                    <th scope="col"></th>
                </tr>
                @foreach ($routes as $route)
                    <tr>
                        <td>
                            {{$route->title}}
                        </td>
                        <td><textarea disabled>{{$route->description}}</textarea></td>
                        <td>{{$route->duration}} Horas</td>
                        <td>${{$route->price}}(COP)</td>
                        <td><textarea disabled>{{$route->schedule}}</textarea></td>
                        <td>
                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                <div class="btn-group" role="group" aria-label="Link options">            
                                    <a href="{{ route('route.show', $route->id) }}" class=" btn btn-info">Ver</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </table> 
                <p class="text-center">
                    <a href="{{ route('walk.create') }}" class="btn btn-primary" title="Crear"><i class="fas fa-plus-circle"></i>Pedir paseo</a>            
                </p>
            </div>
        </div>
    </div>
@endsection
