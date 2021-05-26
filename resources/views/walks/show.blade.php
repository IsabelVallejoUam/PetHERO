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
                @if($route!= null)
                    <td>${{ $route->price }}(COP)</td>
                @else
                    <td>Sin asignar</td>
                @endif
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

                <tr>
                    <th scope="col">Calificación para el paseador:</th>
                    <td>{{ $walk->walker_calification }}/5 </td>
                </tr>

                <tr>
                    <th scope="col">Calificación para la mascota:</th>
                    <td>{{ $walk->pet_calification }}/5</td>
                </tr>
                @endif
            @if($walk->status == 'canceled' || $walk->status == 'rejected')  
                <tr>
                    <th scope="col">Motivo de cancelación</th>
                    <td>"{{ $walk->commentary }}"</td>
                </tr>
            @else
                <tr>
                    <th scope="col">Comentario del usuario</th>
                    <td>"{{ $walk->commentary }}"</td>
                </tr>
            @endif
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
        @if($route!=null)
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
        @else <h3>Sin asignar</h3>
        @endif 

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
            @if($walk->walker != null)
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
                        @if($walk->status != 'pending' && $walk->status != 'canceled' && $walk->status != 'rejected')
                            {{$walker->owner->phone}}
                        @endif
                    </td>
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
            @else <h3>Sin asignar</h3>
            @endif

            <h3>Cliente</h3>
            <table class="table table-striped table-hover">
                <tr>
                    <th scope="col">Dueño de mascota</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Acciones
                    </th>
                </tr>
                <tr>
                    <td>
                        <img src="/uploads/avatars/{{$user->owner->avatar }}" style="width: 35px; height:35px; position:relarive;" />
                        {{$user->owner->name}} {{$user->owner->lastname}}
                    </td>
                    <td>{{$user->owner->phone}}</td>
                    <td>{{$user->owner->email}}</td>
                    <td>{{$user->address}}</td>
                    <td>
                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group" role="group" aria-label="Link options">
                                <a href="{{ route('petOwner.profile', $walk->user_id) }}" class=" btn btn-primary">Ver usuario</a>
                            </div>
                        </div>
                    </td>
                </tr>
            </table> 

            @if($walk->walker != null)
            <h3>Chat</h3>
            {{--Chat--}}
            <table class="table table-striped table-hover">
                @foreach ($chats as $chat)
                <tr>
                    <th scope="col">
                        Respuesta de {{$chat->owner->name}} <br>
                        <img src='/uploads/avatars/{{$chat->owner->avatar}}' width="100px">
                    </th>
                    <td>
                        <textarea disabled class="form-control" type="text" name="content" id="content">{{$chat->content}}
                        </textarea>El {{$chat->created_at->format('d/m/y')}} a las {{$chat->created_at->format('H:m')}}
                    </td>
                </tr>
                @endforeach
                @if($walk->status == 'accepted' || $walk->status == 'active')
                    <tr>
                        <th scope="col">
                            <img src='/uploads/avatars/{{Auth::user()->avatar}}' width="100px">
                        </th>
                        <form action="{{ route('chats.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <td>
                                <input type="hidden" name="owner_id" value="{{Auth::id()}}">
                                <input type="hidden" name="walk_id" value="{{$walk->id}}">
                                Escribe una respuesta:
                                <textarea class="form-control" type="text" name="content" id="content"></textarea>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-plus-square"></i>Enviar</button>
                            </td>
                        </form>   
                    </tr>
                @endif
            </table>
            @endif
        </div>
    </div>
</div>


@endsection