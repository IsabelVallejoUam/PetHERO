@extends('layouts.app')
@section('content')
@include('layouts.validation-error')
<form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
@csrf
<div class="container p-2">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><a type="button" class="btn btn-secondary mb-4 mt-2 " href="{{ route('forum.index') }}"><i class="far fa-hand-point-left"></i> Volver</a><br>
                Crear un nuevo post
                </div>
                <div class="card-body">
                    <div class="row" style="display: block;">
                        <div class="form-group">
                            <label for="title"> Título de tu publicación</label>
                            <input class="form-control" type="text" name="title" id="title">
                        </div>
                    </div>

                    <div class="row form-group">
                        <label for="content"> Contenido</label>
                        <textarea class="form-control" type="text" name="content" id="content"></textarea><script>
                            CKEDITOR.replace( 'content',{
                            width: "1000px",
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
                            <option value="public"></i>Público (visible para todos los usuarios)</option>
                            </select>
                        </label>
                    </div>
                    <div class="row center">
                        <div class="col s6">
                            <button class="btn btn-primary" type="submit"> Publicar </button>
                            <a href="{{ url()->previous()  }}"><button type="button" class="btn btn btn-danger">Cancelar</button></a>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </div>
</div>     
</form>
    
@endsection