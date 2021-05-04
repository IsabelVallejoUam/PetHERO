@extends('layouts.app')
@section('content')
       <div class="card container align-middle" style="width:500px;"> 
        <a type="button" style="width: 100px;" class="btn btn-secondary mb-4 mt-2" href="{{ route('walker.index') }}"><i class="far fa-hand-point-left"></i> Volver</a>
 
        <h1>Ruta de {{ $route->owner->name }} <i class="fas fa-route"></i>
            <p>
                <img src="/uploads/avatars/{{$route->owner->avatar}}" style="width:150px; border-radious:50%; display: block; margin-left: auto; margin-right: auto;"/>
            </p>
        
        </h1>
        <div class="container">
            @if(Auth::id() == $route->owner_id)
            <p class="text-center" style="margin-bottom: 20px"><b>Visibilidad</b> 
                @if ($route->privacy == 'private')
                    Pública <i class="fas fa-lock"></i>
                @else
                    Privada <i class="fas fa-lock-open"></i>
                @endif
            </p>
            <br>
            <p class="text-center" style="margin-bottom: 20px"><b>Nombre de la ruta:</b> {{$route->title}} </p>
            <br>
            <p class="text-center" style="margin-bottom: 20px"><b>Descripción: </b>{{$route->description}} </p>
            <br>
            <p class="text-center" style="margin-bottom: 20px"><b>Duración estimada:</b> {{$route->duration}} Horas </p>
            <br>
            <p class="text-center" style="margin-bottom: 20px"><b>Precio por paseo:</b> {{$route->price}} Horas </p>
            <br>
            <p class="text-center" style="margin-bottom: 20px"><b>Horario:</b> {{$route->schedule}} Horas </p>
            <br>
            <p class="text-center" style="margin-bottom: 20px"><a href="{{ route('walk.create') }}" class="btn btn-primary" title="Crear"><i class="fas fa-plus-circle"></i>Pedir paseo en esta ruta</a></p>
            
            @endif
        </div>
    </div>
@endsection