@extends('layouts.app')

@section('content')
<?php
    $authenticated = false;
    use Illuminate\Support\Facades\Auth;
    if (Auth::id() == $post->owner_id){ //Verifica que el usuario sea el mismo dueño del post
        $authenticated = true;
    } else {
        $authenticated = false;
    }
?>
<div class="container">
    <a type="button" class="btn btn-secondary mb-4 mt-2 " href="{{ url()->previous() }}"><i class="far fa-hand-point-left"></i> Volver</a><br>
    <h1>{{ $post->title }}
    @if($authenticated)
        @if ($post->privacy == 'public')
            <i class="fas fa-lock-open"></i>
        @else
            <i class="fas fa-lock"></i>
        @endif
    @endif
    </h1>
    <table class="table table-striped table-hover">
        <tr>
            <th scope="col" style="width: 200px">Propietario</th>
            <td>{{ $post->owner->name }}</td>
        </tr>
        <tr>
            <th scope="col">Fecha de craación</th>
            <td>{{ $post->created_at->format('d/m/y') ?? "Desconocida" }}</td>
        </tr>
        <tr>
            <th scope="col">Última actualización</th>
            <td>{{ $post->updated_at->format('d/m/y') ?? "Desconocida" }}</td>
        </tr>
        <tr><th scope="col">Contenido</th>
            <td><textarea disabled class="form-control" type="text" name="content" id="content">{!!$post->content!!}</textarea><script>
                CKEDITOR.replace( 'content',{width: "900px",height: "400px",});</script>
            </td>
        </tr>
        </tr>
        @foreach ($answers as $answer)
        <tr>
            <th scope="col">
                Respuesta de {{$answer->owner->name}} @if ($answer->created_at != $answer->updated_at)
                <i>(Editada)</i><br>
            @endif
                
                <img src='/uploads/avatars/{{$answer->owner->avatar}}' width="100px">
            </th>
            <td>
                <textarea disabled class="form-control" type="text" name="content" id="content">{{$answer->content}}</textarea>
                <?php
                    $owner = false;
                    if (Auth::id() == $answer->owner_id){ //Verifica que el usuario sea el mismo dueño del post
                        $owner = true;
                    } else {
                        $owner = false;
                    }
                ?>
                @if ($owner)
                <a href="{{ route('comment.edit', ['comment' => $answer->id]) }}" class=" btn btn-warning" title="Editar"><i class="far fa-edit"></i> Editar</a>
                <form action="{{ route('comment.destroy', $answer->id) }}" method="post"
                    onsubmit="return confirm('¿Esta seguro que desea remover el post?')">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger" title="Remover"><i class="fas fa-trash-alt"></i>Eliminar comentario</button>  
                </form>
                @endif
            </td>
        </tr>
        @endforeach
        @if(Auth::check())
            <tr>
                <th scope="col">
                <img src='/uploads/avatars/{{Auth::user()->avatar}}' width="100px">
            </th>
                <form action="{{ route('comment.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <td>
                        <input type="hidden" name="owner_id" value="{{Auth::id()}}">
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                        Escribe un comentario:
                        <textarea class="form-control" type="text" name="content" id="content"></textarea>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-plus-square"></i>Comentar</button>
                    </td>
                </form>   
            </tr>
        @endif
    </table>

        
    @if($authenticated)
    <div class="btn-group" role="group" aria-label="Link options">
        <a href="{{ route('post.edit', ['post' => $post->id]) }}" class=" btn btn-warning" title="Editar"><i class="far fa-edit"></i> Editar</a>
        <form action="{{ route('post.destroy', $post->id) }}" method="post"
            onsubmit="return confirm('¿Esta seguro que desea remover el post?')">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger" title="Remover"><i class="fas fa-trash-alt"></i>Eliminar post</button>  
        </form>
    </div>
    @endif
    
    


</div>
@endsection 