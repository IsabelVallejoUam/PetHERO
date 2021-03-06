@extends ('layouts.app')
@section('content')
<div class="card container">
    <h1 style="text-align: center;">Posts</h1><br>
    {{$posts->links()}}<br>
    <div class="container">
        @foreach ($posts as $post)
            <div class="card" style = "width: 20rem; margin:10px; display:inline-block;">
                <h3>{{$post->title}}
                    
                    <?php
                        $authenticated = false;
                        if (Auth::id() == $post->owner_id){ //Verifica que el usuario sea el mismo dueño del post
                            $authenticated = true;
                        } else {
                            $authenticated = false;
                        }
                    ?>
                    @if($authenticated)
                        @if ($post->privacy == 'public')
                            <i class="fas fa-lock-open"></i>
                        @elseif ($post->privacy == 'private')
                            <i class="fas fa-lock"></i>
                        @endif
                    @endif
                    
                </h3>
                <h6> Escrito por: <u>{{$post->owner->name}} </u></h6>
                <img class="card-img-top" src="/uploads/avatars/{{$post->owner->avatar}}" style="border-radius: 2rem; padding:15px;width:200px;float:left; display:flex;" >      
                
                <div class="card-body">
                    <div class="container"  style="display:flow-root;">
                        <b>Previsualizar</b>
                        @if ($post->created_at != $post->updated_at)
                            <i>(Edited)</i>
                        @endif
                        <?php 
                            $html2TextConverter = new \Html2Text\Html2Text($post->content);
                            $text = strip_tags($html2TextConverter->getText());
                            $text = html_entity_decode($text);
                        ?>
                        <textarea disabled class="form-control" type="text" name="content" id="content" style="height: 50px;"> {{substr($text,0,20)}}...</textarea>
                        <small><b>
                            <div class="text-right" style="display: block">Publicado el {{$post->created_at->format('d/m/Y')}}</div>
                        </small></b>
                        <?php
                            $responses = \App\Models\Comment::where('post_id',$post->id)->count();
                        ?><br>
                        <i>{{$responses}} respuestas</i><br>
                    </div>
                    <a href="{{ route('post.show', $post->id) }}" class=" btn btn-info"><i class="fas fa-eye"></i>Leer {{$post->title}}</a>
                </div>
            </div> 
        @endforeach
        @if (Auth::id() == null)
        <a type="button" class="btn btn btn-secundary " href="{{ route('login') }}"> Registrate para crear un post</a>      
        @else
            <p class="text-center">
                <a type="button" class="btn btn-primary " href="{{ route('post.create') }}"><i class="fas fa-plus-square"></i> Crear nuevo post</a> 
            </p>
        @endif
    </div>          
</div>
@endsection



