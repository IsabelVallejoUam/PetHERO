@extends('layouts.app')

@section('content')
<div class="container">
    <a type="button" class="btn btn-secondary mb-4 mt-2" href="{{ url()->previous() }}"><i class="far fa-hand-point-left"></i> Volver</a>
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
    
    <div class="jumbotron"> <h1>Mis tiendas</h1> 
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
</div>

@endsection