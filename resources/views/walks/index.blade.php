@extends ('layouts.app')
@section('content')
<?php
use App\Models\Route;
use App\Models\Walker;
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
            <th scope="col">
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
                            <a href="{{ route('route.show', $route->id) }}" class=" btn btn-info">Ver</a>
                            {{-- <form action="{{ route('route.destroy', $route->id) }}" method="post"
                                onsubmit="return confirm('¿Esta seguro que desea remover esta ruta?')">
                                @csrf
                                @method('delete')
                                <button type="submit" class=" btn btn-danger">Borrar</button>
                            </form> --}}
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>        
    @if (Auth::id() == null)
        <a type="button" class="btn btn btn-secundary " href="{{ route('login') }}"> Registrate para crear un post</a>      
    @else
        <p class="text-center">
            <a type="button" class="btn btn-primary " href="{{ route('post.create') }}"><i class="fas fa-plus-square"></i> Crear nuevo post</a> 
        </p>
    @endif
</div>
@endsection