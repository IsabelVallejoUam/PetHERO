@extends('layouts.app')
@include('layouts.validation-error')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><a type="button" class="btn btn-secondary mb-4 mt-2 " href="{{ url()->previous() }}"><i class="far fa-hand-point-left"></i> Volver</a><br>
                    Asignale ruta a este paseo para {{$walk->owner->name}}
                </div>
                <form action="{{ route('walk.submitWalkerAcceptRequest') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="route" class="form-label">Asignar ruta</label>
                            <select name="route_id" class="form-control" id="route_id">
                                @foreach ($routes as $route)
                                    <option value="{{$route->id}}">{{$route->title}}</option>
                                @endforeach
                            </select>
                        </div>  
                        <input type="hidden" name="walk_id" value="{{$walk->id}}" id="walk_id">
                    </div>
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection