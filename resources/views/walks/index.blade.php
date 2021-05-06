@extends ('layouts.app')
@section('content')
<?php
use App\Models\Route;
use App\Models\Walker;

?>
<div class="card" style="margin: 100px; margin-top:0px">
    @if(!$request)
        <h1 style="text-align: center;">Mis paseos</h1><br>
    @elseif($type == 'walker')
        <h1 style="text-align: center;">Solicitudes de paseo disponibles</h1><br>
    @elseif($type == 'petOwner')
        <h1 style="text-align: center;">Mis solicitudes pendietes</h1><br>
    @endif
    {{$walks->links()}}<br>
    
    <table class="table table-striped table-hover">
        <tr>
            <th scope="col">Mascota</th>
            <th scope="col">Ruta</th>
            <th scope="col">Paseador</th>
            <th scope="col">Estado</th>
            <th scope="col">Fecha</th>
            <th scope="col">Hora</th>
            <th scope="col">Acciones</th>
        </tr>
        
        @foreach ($walks as $walk)
        <?php
        if($walk->route != -1){
            $route = Route::where('id','=',$walk->route)->first();
        }
            $walker = Walker::where('user_id','=',$walk->walker)->first();
        ?>
            <tr>
                <td>
                    <img src="/uploads/pets/{{ $walk->pet->photo }}" style="width: 35px; height:35px; position:relarive;" />
                    {{$walk->pet->name}}   {{$walk->id}}
                </td>
                @if($route!=null)
                    <td>{{$route->title}}<br>
                        @if ($walk->status == 'finished')
                            Minutos caminados: {{$walk->minutes_walked}}    
                        @endif
                    </td>
                @else
                    <td>Sin ruta asignada
                        @if ($route == null && $walk->status == 'pending' && $type == 'walker' && !$request)
                            <form action="{{route('walk.addRoute')}}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="walker_id" value="{{$walk->walker}}">
                                <p class="text-center">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i>Asignar ruta</button>
                                </p>
                            </form>
                        @endif
                    </td>
                    @endif
                    @if(!$request)
                        <td>
                            <img src="/uploads/avatars/{{$walker->owner->avatar}}" style="width: 35px; height:35px; position:relarive;" />
                            {{$walker->owner->name}}
                        </td>
                    @else
                        <td>
                            Sin paseador asignado
                        </td>
                    @endif
                <td>{{$walk->status}}<br>
                    @if ($walk->status == 'rejected' )
                        <textarea disabled>Motivo de rechazo:{{$walk->commentary}}</textarea>
                    @elseif ($walk->status == 'canceled' )
                        <textarea disabled>Motivo de cancelación:{{$walk->commentary}}</textarea> <br> 
                        @if($walk->cancel_confirmation == 'no' && $type == 'walker')    
                            <p style="width: 150px">En espera de confirmación para la cancelación por parte del usuario</p>
                        @elseif($walk->cancel_confirmation == 'no' && $type == 'petOwner')
                        <p style="width: 150px">En espera de confirmación para la cancelación por parte del paseador</p>
                        @endif
                    @endif
                </td>
                <td>{{$walk->requested_day}}</td>
                <td>{{$walk->requested_hour}}</td>
                <td>
                    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group" role="group" aria-label="Link options">
                            <a href="{{ route('walk.show', $walk->id) }}" class=" btn btn-info">Ver detalles</a>

                            @if ($walk->status == 'pending' && !$request)
                                @if($type == 'walker')
                                    <form action="{{route('walk.walkerAccept')}}" method="POST" 
                                    onsubmit="return confirm('¿Esta seguro que desea confirmar este paseo?')">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="walk_id" value="{{$walk->id}}" id="walk_id">
                                        <button type="submit" class="btn btn-primary">Aceptar petición</button>
                                    </form>
                                    <form action="{{route('walk.walkerReject')}}" method="POST" 
                                    onsubmit="return confirm('¿Esta seguro que desea rechazar este paseo?')">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="walk_id" value="{{$walk->id}}" id="walk_id">
                                        <button type="submit" class="btn btn-secondary">Rechazar petición</button>
                                    </form>
                                @endif
                                @if($type == 'petOwner')
                                    <form action="{{ route('walk.destroy', $walk->id) }}" method="post"
                                        onsubmit="return confirm('¿Esta seguro que desea eliminar este paseo?')">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class=" btn btn-danger">Borrar</button>
                                    </form>
                                @endif
                                @elseif($request)
                                    @if($type == 'walker')
                                    <form action="{{route('walk.walkerAcceptRequest')}}" method="POST" 
                                    onsubmit="return confirm('¿Esta seguro que desea aceptar este paseo?')">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="walk_id" value="{{$walk->id}}" id="walk_id">
                                        <button type="submit" class="btn btn-primary">Aceptar petición</button>
                                    </form>
                                    @else
                                        <form action="{{ route('walk.destroy', $walk->id) }}" method="post"
                                            onsubmit="return confirm('¿Esta seguro que desea eliminar esta solicitud?')">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class=" btn btn-danger">Borrar</button>
                                        </form>
                                    @endif
                            @endif

                            @if ($walk->status == 'accepted')
                                @if($type == 'walker')

                                    <form action="{{route('walk.walkerCancel')}}" method="POST" 
                                    onsubmit="return confirm('¿Esta seguro que desea cancelar este paseo?')">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="walk_id" value="{{$walk->id}}">
                                        <input type="hidden" name="type" value="{{$type}}">
                                        <button type="submit" class="btn btn-danger">Cancelar</button>
                                    </form>

                                    <form action="{{route('walk.start')}}" method="POST" 
                                    onsubmit="return confirm('¿Esta seguro que desea iniciar?')">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="walk_id" value="{{$walk->id}}" id="walk_id">
                                        <button type="submit" class="btn btn-primary">Iniciar paseo</button>
                                    </form>
                                @endif
                                @if($type == 'petOwner')
                                    <form action="{{route('walk.petOwnerCancel')}}" method="POST" 
                                    onsubmit="return confirm('¿Esta seguro que desea cancelar este paseo?')">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="walk_id" value="{{$walk->id}}">
                                        <input type="hidden" name="type" value="{{$type}}">
                                        <button type="submit" class="btn btn-danger">Cancelar</button>
                                    </form>
                                    
                                @endif
                            @endif


                            @if ($walk->status == 'active')
                                @if($type == 'walker')
                                    <form action="{{route('walk.walkerFinish')}}" method="POST" 
                                    onsubmit="return confirm('¿Esta seguro que desea finalizar este paseo?')">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="walk_id" value="{{$walk->id}}" id="walk_id">
                                        <button type="submit" class="btn btn-primary">Finalizar paseo</button>
                                    </form>
                                @endif
                            @endif


                            @if (($walk->status == 'canceled' && $walk->cancel_confirmation == 'yes') 
                                || $walk->status == 'rejected')
                                <form action="{{ route('walk.destroy', $walk->id) }}" method="post"
                                    onsubmit="return confirm('¿Esta seguro que desea eliminar este paseo?')">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class=" btn btn-danger">Borrar</button>
                                </form>
                            @endif
                                
                            @if ($walk->status == 'canceled' && $walk->cancel_confirmation == 'no')
                                @if($walk->walker_confirmation == 'yes' && $type == 'petOwner')
                                    <form action="{{route('walk.confirmCancel')}}" method="POST" 
                                    onsubmit="return confirm('¿Esta seguro que desea confirmar cancelación?')">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="walk_id" value="{{$walk->id}}" id="walk_id">
                                        <input type="hidden" name="type" value="{{$type}}" id="type">
                                        <button type="submit" class="btn btn-danger">Aceptar cancelación</button>
                                    </form>
                                @endif

                                @if($walk->walker_confirmation == 'no' && $type == 'walker')
                                <form action="{{route('walk.confirmCancel')}}" method="POST" 
                                onsubmit="return confirm('¿Esta seguro que desea confirmar cancelación?')">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="walk_id" value="{{$walk->id}}" id="walk_id">
                                    <input type="hidden" name="type" value="{{$type}}" id="type">
                                    <button type="submit" class="btn btn-danger">Aceptar cancelación</button>
                                </form>
                            @endif
                            @endif
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>    
     
    @if ($type == 'petOwner')
    <p class="text-center">
        <a type="button" class="btn btn-primary " href="{{ route('walk.create') }}"><i class="fas fa-plus-square"></i>Pedir servicio a un paseador</a> 
    </p>
    <p class="text-center">
        <a type="button" class="btn btn-primary " href="{{ route('walk.createRequest') }}"><i class="fas fa-plus-square"></i>Publicar solicitud de paseo</a> 
    </p>
    @endif
</div>


@endsection