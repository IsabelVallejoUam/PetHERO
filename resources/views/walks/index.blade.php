@extends ('layouts.app')
@section('content')
<?php
    use App\Models\Route;
    use App\Models\Walker;

    $type = '';
    $id = Auth::id();
    use App\Models\PetOwner;
    $pet = PetOwner::find($id);
    $walker = Walker::find($id);
    if (isset($pet)) {
    $type = 'petOwner';
    } 
    if (isset($walker)) {
    $type = 'walker';
    }
?>

<div class="card" style="margin: 100px; margin-top:0px">
    <h1 style="text-align: center;">Mis paseos</h1><br>
    {{$walks->links()}}<br>
    <table class="table table-striped table-hover">
        <tr>
            <th scope="col">Mascota</th>
            <th scope="col">Ruta</th>
            <th scope="col">Paseador</th>
            <th scope="col">Estado</th>
            <th scope="col">Fecha</th>
            <th scope="col">Hora</th>
            <th scope="col">Acciones
            </th>
        </tr>
        
        @foreach ($walks as $walk)
        <?php
            $route = Route::where('id','=',$walk->route)->first();
            $walker = Walker::where('user_id','=',$walk->walker)->first();
        ?>
            <tr>
                <td>
                    <img src="/uploads/pets/{{ $walk->pet->photo }}" style="width: 35px; height:35px; position:relarive;" />
                    {{$walk->pet->name}}
                    
                </td>
                <td>{{$route->title}}</td>
                <td>
                    <img src="/uploads/avatars/{{$walker->owner->avatar}}" style="width: 35px; height:35px; position:relarive;" />
                    {{$walker->owner->name}}</td>
                <td>{{$walk->status}}</td>
                <td>{{$walk->requested_day}}</td>
                <td>{{$walk->requested_hour}}</td>
                <td>
                    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group" role="group" aria-label="Link options">
                            <a href="{{ route('walk.show', $route->id) }}" class=" btn btn-info">Ver detalles</a>
                            @if ($walk->status != 'canceled')
                                <form action="{{route('walk.cancel')}}" method="POST" 
                                onsubmit="return confirm('¿Esta seguro que desea cancelar este paseo?')">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="walk_id" value="{{$walk->id}}">
                                    <input type="hidden" name="type" value="{{$type}}">
                                    <button type="submit" class="btn btn-danger">Cancelar</button>
                                </form>
                            @elseif($walk->status != 'canceled' && $walk->cancel_confirmation == 'yes')
                                <form action="{{ route('walk.destroy', $walk->id) }}" method="post"
                                    onsubmit="return confirm('¿Esta seguro que desea eliminar este paseo?')">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class=" btn btn-danger">Borrar</button>
                                </form>
                            @endif
                            @if ($walk->status == 'canceled' && $walk->cancel_confirmation == 'no')
                                <form action="{{route('walk.confirmCancel')}}" method="POST" 
                                onsubmit="return confirm('¿Esta seguro que desea confirmar cancelación?')">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="walk_id" value="{{$walk->id}}" id="walk_id">
                                    <input type="hidden" name="type" value="{{$type}}" id="type">
                                    <button type="submit" class="btn btn-danger">Aceptar cancelación</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>        
    @if (Auth::id() == null && $type == 'petOwner')
        <a type="button" class="btn btn btn-secundary " href="{{ route('login') }}"> Pedir un nuevo paseo</a>      
    @else
        <p class="text-center">
            <a type="button" class="btn btn-primary " href="{{ route('post.create') }}"><i class="fas fa-plus-square"></i> Crear nuevo post</a> 
        </p>
    @endif
</div>


@endsection