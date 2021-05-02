
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><a type="button" class="btn btn-secondary mb-4 mt-2 " href="{{ url()->previous() }}"><i class="far fa-hand-point-left"></i> Volver</a><br>
                     Editar una respuesta
                </div>
                <form action="{{route('comment.update',$comment->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <input type="hidden" name="post_id" value="{{$comment->post_id}}">
                        <div class="row form-group">
                            <label for="content"> Contenido</label>
                            <textarea class="form-control" type="text" name="content" id="content">{{old('content', $comment->content ?? Desconocido)}}</textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Editar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection