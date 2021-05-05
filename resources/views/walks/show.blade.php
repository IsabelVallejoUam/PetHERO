@extends ('layouts.app')
@section('content')
<?php
    use App\Models\Route;
    use App\Models\Walker;

    $type = '';
    $id = Auth::id();
    use App\Models\PetOwner;
    $pet = PetOwner::find($id);
    $isWalker = Walker::find($id);
    if (isset($pet)) {
    $type = 'petOwner';
    } 
    if (isset($isWalker)) {
    $type = 'walker';
    }
?>

<div class="card container">
    <div class="container">
        <a type="button" class="btn btn-secondary mb-4 mt-2" href="{{ url()->previous() }}"><i
                class="far fa-hand-point-left"></i> Volver</a>
        <a>
            <h1 style="position:static; display:block; margin-left:auto; margin-right:auto;"
                class="p-1 text-center">Paseo para {{ $walk->owner->name . ' ' . $walk->owner->lastname }} 
            <img src="/uploads/avatars/{{ $walk->owner->avatar }}"
                style="width:150px; border-radious:50%; display: block; margin-left: auto; margin-right: auto;" />
            </h1>
        </a>
        <table class="table table-striped table-hover">
            <h3>Infromación del paseo</h3>
            <tr>
                <th scope="col">Fecha programada</th>
                <td>{{$walk->requested_day}}</td>
            </tr>
            <tr>
                <th scope="col">Hora programada</th>
                <td>{{$walk->requested_hour}}</td>
            </tr>
            <tr>
                <th scope="col">Precio</th>
                <td>${{ $route->price }}(COP)</td>
            </tr>
            <tr>
                <th scope="col">Tiempo mínimo pedido</th>
                <td>{{ $walk->min_time }} Horas</td>
            </tr>
            <tr>
                <th scope="col">Tiempo máximo pedido</th>
                <td>{{ $walk->max_time }} Horas</td>
            </tr>
            @if($walk->status == 'finished')
                <tr>
                    <th scope="col">Tiempo caminado</th>
                    <td>{{ $walk->minutes_walked }} Minutos</td>
                </tr>
                @endif
            <tr>
                <th scope="col">Comentario del usuario</th>
                <td>"{{ $walk->commentary }}"</td>
            </tr>
            <tr>
                <th scope="col">Estado</th>
                <td>
                    {{ $walk->status }}
                    @if ($walk->status == 'canceled')
                        <i class="fas fa-ban"></i>
                    @elseif ($walk->status == 'accepted') 
                        <i class="fas fa-battery-empty"></i>
                    @elseif ($walk->status == 'active') 
                        <i class="fas fa-battery-half"></i>
                    @elseif ($walk->status == 'finished') 
                        <i class="fas fa-battery-full"></i>
                    @elseif ($walk->status == 'pending') 
                        <i class="fas fa-spinner"></i>
                    @elseif ($walk->status == 'rejected') 
                        <i class="fas fa-ban"></i>
                    @endif
                </td>
            </tr>
        </table>

        <h3>Ruta</h3>
        {{--Rutas del paseador--}}
        <table class="table table-striped table-hover">
            <tr>
                <th scope="col">Ruta</th>
                <th scope="col">Descripción</th>
                <th scope="col">Precio</th>
                <th scope="col">Duración estimada</th>
                <th scope="col">Acciones
                </th>
            </tr>
            <tr>
                <td>{{ $route->title}}</td>
                <td>{{$route->description}}</td>
                <td>${{ $route->price }}(COP)</td>
                <td>{{ $route->duration }} Horas</td>
                <td>
                    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group" role="group" aria-label="Link options">
                            <a href="{{ route('route.show',$route->id) }}" class="btn btn-primary" title="Ver">Ver ruta</a> 
                        </div>
                    </div>
                </td>
            </tr>
            </table> 

        <h3>Mascota</h3>
        {{--Mascota--}}
        <table class="table table-striped table-hover">
            <tr>
                <th scope="col">Mascota</th>
                <th scope="col">Edad</th>
                <th scope="col">Raza</th>
                <th scope="col">Sexo</th>
                <th scope="col">Personalidad</th>
                <th scope="col">Tamaño</th>
                <th scope="col">Comentario del dueño</th>
                <th scope="col">Acciones
                </th>
            </tr>
            <tr>
                <td>
                    <img src="/uploads/pets/{{ $walk->pet->photo }}" style="width: 35px; height:35px; position:relarive;" />
                    {{$walk->pet->name}}
                    
                </td>
                <td>{{$walk->pet->age}}</td>
                <td>
                    {{$walk->pet->race}}</td>
                <td>{{$walk->pet->sex}}</td>
                <td>{{$walk->pet->personality}}</td>
                <td>{{$walk->pet->size}}</td>
                <td>{{$walk->pet->commentary}}</td>
                <td>
                    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group" role="group" aria-label="Link options">
                            <a href="{{ route('pet.show', $walk->pet->id) }}" class=" btn btn-primary">Ver mascota</a>
                        </div>
                    </div>
                </td>
            </tr>
            </table> 

            <h3>Paseador</h3>
            <table class="table table-striped table-hover">
                <tr>
                    <th scope="col">Paseador</th>
                    <th scope="col">Experiencia (años)</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Calificación</th>
                    <th scope="col">Acciones
                    </th>
                </tr>
                <tr>
                    <td>
                        <img src="/uploads/avatars/{{$walker->owner->avatar }}" style="width: 35px; height:35px; position:relarive;" />
                        {{$walker->owner->name}} {{$walker->owner->lastname}}
                        <br><i>"{{$walker->slogan}}"</i>
                    </td>
                    <td>{{$walker->experience}}</td>
                    <td>
                        {{$walker->owner->phone}}</td>
                    <td>{{$walker->owner->email}}</td>
                    <td>{{$walker->score}}</td>
                    <td>
                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group" role="group" aria-label="Link options">
                                <a href="{{ route('walker.profile', $walk->walker) }}" class=" btn btn-primary">Ver paseador</a>
                            </div>
                        </div>
                    </td>
                </tr>
            </table> 


        </div>
    </div>
</div>


@endsection