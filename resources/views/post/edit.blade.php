@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><a type="button" class="btn btn-secondary mb-4 mt-2 " href="{{ url()->previous() }}"><i class="far fa-hand-point-left"></i> Volver</a><br>
                     Editar un post
                </div>
                <form action="{{route('post.update',$post->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card-body">

                        <div class="row" style="display: block;">
                            <div class="form-group">
                                <label for="title"> Título de tu publicación</label>
                                <input class="form-control" type="text" name="title" id="title" value="{{old('title', $post->title)}}">
                            </div>
                        </div>

                        <div class="row form-group">
                        <label for="content"> Contenido</label>
                        <textarea class="form-control" type="text" name="content" id="content">{{old('content', $post->content)}}</textarea><script>
                            CKEDITOR.replace( 'content',{
                            width: "1200px",
                            height: "300px",
                            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
                            filebrowserUploadMethod: 'form'
                            }); 
                        </script>
                        </div>

                        <div class="row form-group">
                            <label for="privacy">Privacidad</label>
                                <select name="privacy" class="form-control" id="privacy">
                                <option value="private" selected="selected">Privado (solo tú lo podrás ver)</option>
                                <option value="public">Público (visible para todos los usuarios)</option>
                                </select>
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Editar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection