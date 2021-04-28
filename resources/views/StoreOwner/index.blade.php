@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ver Datos de {{ $user->name. ' ' .$user->lastname  }} como Dueño de Tiendas</h1>
    <a type="button" class="btn btn-secondary mb-4 mt-2" href="{{ url()->previous() }}"><i class="far fa-hand-point-left"></i> Volver</a>
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
    
    <div class="jumbotron"> <h1>Tus tiendas</h1> 
        @foreach ($stores as $store)
        <div class="card" style="width: 18rem; display:inline-block; margin:10px;">
        <div class="card-body">
          <h4 class="card-title">{{$store->store_name}}</h4>
          <h5> <b>{{$store->slogan}}</b></h5>
          <h6> {{$store->description}}</h6>
          {{-- <a href="{{ route('category.show', $category->id) }}" class=" btn btn-info"><img src="https://www.flaticon.com/svg/vstatic/svg/822/822102.svg?token=exp=1618288348~hmac=3cf6eedf10846c17eae23b4bf4d5b78b" height="25"/> Ver {{$category->title}}</a> --}}
        </div>
      </div>
    @endforeach
    </div>

    <div class="btn-group" role="group" aria-label="Link options">
        <a href=""{{--"{{ route('walker.edit', auth()->user()->document) }}"--}} class="btn btn-warning" title="Editar"><i class="far fa-edit"></i></a>
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