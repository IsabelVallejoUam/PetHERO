@extends('layouts.app')

@section('content')
<div class="card container">
    <a type="button" style="width: 100px;" class="btn btn-secondary mb-4 mt-2" href="{{ url()->previous() }}"><i class="far fa-hand-point-left"></i> Volver</a>
    <a>
        <h1 style="position:static; display:block; margin-left:auto; margin-right:auto;" class="p-1 text-center">Perfil de {{ $user->name. ' ' .$user->lastname  }}  (Dueño de Tiendas)</h1>
        <img src="/uploads/avatars/{{$user->avatar}}" style="width:150px; border-radious:50%; display: block; margin-left: auto; margin-right: auto;"/><br>
    </a>
    <table class="table table-striped table-hover">
        <tr>
            <th scope="col">Full Name</th>
            <td>{{ $user->name. ' ' .$user->lastname  }}</td>
        </tr>
        <tr>
            <th scope="col">Email</th>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th scope="col">Phone Number</th>
            <td>{{ $user->phone }}</td>
        </tr>
    </table>
    
    <div class="container"> <h1>Mis establecimientos</h1> 
        @foreach ($stores as $store)
        <?php
        $rate = \App\Models\Review::where('type','store')->where('store_id',$store->id)->avg('rate');
        $overallCount = App\Models\Review::where('type','store')->where('store_id',$store->id)->count();
    ?>
        <div class="card" style="width: 18rem; display:inline-block; margin:10px;">
            <img class="card-img-top" src="/uploads/stores/{{$store->photo}}" alt="Card image cap">
            <div class="card-body">
                <h4 class="card-title"><b>{{$store->store_name}}</b></h4>
                <h5> <i>"{{$store->slogan}}"</i></h5>
                <h6> {{$store->description}}</h6>
                <p><b>Horario:</b> {{$store->schedule}}</p>
                <p><b>Dirección:</b> {{$store->address}}</p>
                <p><b>Teléfono:</b> {{$store->phone_number}}</p>
                @if ($rate != null)
                <p><b>Puntuación:</b> {{$rate}}/5</p>
                @else
                    <p><b>Aún no hay calificaciones</p>
                @endif
                <a href="{{ route('store.show', $store->id) }}" class=" btn btn-info"> Ver {{$store->store_name}}</a>
                <form action="{{route('review.indexStore')}}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="store_id" value="{{$store->id}}" id="store_id"><br>
                    <button type="submit" style="display:block;" class="btn btn-primary">Ver reseñas</button>
                </form>
            </div>
        </div>    
    @endforeach
    </div>
</div>

@endsection