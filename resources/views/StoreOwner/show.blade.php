@extends('layouts.app')

@section('content')
<div class="container">
    <a type="button" class="btn btn-secondary mb-4 mt-2" href="{{ url()->previous() }}"><i class="far fa-hand-point-left"></i> Volver</a>
    <a>
        <h1 style="position:static; display:block; margin-left:auto; margin-right:auto;" class="p-1 text-center">Perfil de {{ $user->name. ' ' .$user->lastname  }}  (Dueño de Tiendas)</h1>
        <img src="/uploads/avatars/{{$user->avatar}}" style="width:150px; border-radious:50%; display: block; margin-left: auto; margin-right: auto;"/>
    </a>
    <table class="table table-striped table-hover">
        <tr>
            <form enctype="multipart/form-data" action="/useravatar" method="POST"
            onsubmit="return confirm('¿Esta seguro que desea cambiar su avatar?')">
                <div style="display:inline-block;">
                    <div class="card w-100">
                        <div class="card-body">
                          <h5 class="card-title">Sube tu propio avatar</h5>
                          <p class="card-text">Elige una de tus fotos como Avatar.</p>
                          <input type="file" name="avatar">
                        <input type="hidden" name="_token" value="{{csrf_token()}}"><br>
                        <input type="submit" class="pull-right btn btn-sm btn-primary mt-2" value="Actualizar avatar">
                        </div>
                      </div>
                </div>
            </form>
        </tr>
        
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
        <tr>
            <th scope="col">Document</th>
            <td>{{ $user->document }}</td>
        </tr>
        <tr>
            <th scope="col">Creado en</th>
            <td>{{ $storeOwner->created_at ?? "Desconocida" }}</td>
        </tr>
        <tr>
            <th scope="col">Actualizado en</th>
            <td>{{ $storeOwner->updated_at ?? "Desconocida"  }}</td>
        </tr>
    </table>
    
    <div class="jumbotron"> <h1>Tus establecimientos</h1> 
        @foreach ($stores as $store)
        <div class="card" style="width: 18rem; display:inline-block; margin:10px;">
            <img class="card-img-top" src="/uploads/stores/{{$store->photo}}" alt="Card image cap">
            <div class="card-body">
                <h4 class="card-title"><b>{{$store->store_name}}</b></h4>
                <h5> <i>"{{$store->slogan}}"</i></h5>
                <h6> {{$store->description}}</h6>
                <p><b>Horario:</b> {{$store->schedule}}</p>
                <p><b>Dirección:</b> {{$store->address}}</p>
                <p><b>Teléfono:</b> {{$store->phone_number}}</p>
                <p><b>Puntuación:</b> {{$store->score}}</p>
                <a href="{{ route('store.show', $store->id) }}" class=" btn btn-info"> Ver {{$store->store_name}}</a>
                <a href="{{ route('store.edit', ['store' => $store->id]) }}" class="btn btn-warning" title="Editar"><i class="far fa-edit"></i>Editar{{$store->store_name}}</a>
                <form action="{{ route('store.destroy', $store->id) }}" method="post"
                    onsubmit="return confirm('¿Esta seguro que desea remover esta tienda?')">
                    @csrf
                    @method('delete')
                    <button type="submit" class=" btn btn-danger">Eliminar</button>
                </form>
                </div>
        </div>
    @endforeach
    </div>

    <div class="btn-group" role="group" aria-label="Link options">
        <form action=""{{--"{{ route('walker.destroy', auth()->user()->document) }}"--}} method="post"
            onsubmit="return confirm('¿Esta seguro que desea eliminar el perfil?')">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger" title="Remover"><i class="fas fa-trash"></i></button>
        </form>
    </div>
    <a href="{{ route('store.create') }}" class="btn btn-primary" title="crear">Añadir tienda<i class="far fa-create"></i></a>
</div>

@endsection