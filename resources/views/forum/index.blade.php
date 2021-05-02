@extends ('layouts.app')
@section('content')
<h1 style="text-align: center;">Posts</h1><br>
    <div class="jumbotron" style="margin: 100px; margin-top:0px">
        @foreach ($posts as $post)
            <div class="card " style=" display:inline-block; margin:20px;; width:350px;">
                <img class="card-img-top" src="/uploads/avatars/{{$post->owner->avatar}}" style="padding:15px;width:200px;float:left;" >      
                <div class="card-body">
                    <div class="container" style="display: inline">
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
                    </div>
                    <div class="container"  style="display:flow-root;">
                        <b>Preview</b>
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
        {{$posts->links()}}<br>
        @if (Route::has('login'))
            <a type="button" class="btn btn-primary " href="{{ route('post.create') }}"><i class="fas fa-plus-square"></i> Crear nuevo post</a> 
        @else
            <a type="button" class="btn btn btn-secundary " href="{{ route('post.create') }}"> Registrate para crear un post</a> 
        @endif
        

@endsection