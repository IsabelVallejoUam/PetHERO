@extends('layouts.app')

@section('content')
<?php
    use App\Models\PetOwner;
    $type = '';
    $pet = PetOwner::find(Auth::id());
    if (isset($pet)) {
        $type = 'petOwner';
    } 
?>
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
                    <th scope="col">Nombre Completo</th>
                    <td>{{ $user->name . ' ' . $user->lastname }}</td>
                </tr>
                <tr>
                    <th scope="col">Correo Electrónico</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th scope="col">Experiencia</th>
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
                                    @if($type =='petOwner')
                                        <form action="{{route('walk.requestNew')}}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="walker_id" value="{{$user->id}}">
                                            <p class="text-center">
                                                <button type="submit" class="btn btn-primary"><i class="fas fa-search-location"></i> Pedir paseo en esta ruta</button>
                                            </p>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </table> 
                @if($type == 'petOwner')
                    <form action="{{route('walk.requestNew')}}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="walker_id" value="{{$user->id}}">
                        <p class="text-center">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-search-location"></i> Pedir paseo en esta ruta</button>
                        </p>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
