@extends('layouts.app')

@section('content')

    <div class="card container-fluid">
        <!-- <div class="row">
             <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <h2 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>FAVORITOS </span>
                    </h2>
                    <ul class="nav flex-column">
                        <li>MASCOTAS</li>
                    </ul>
                    <h4 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span> LISTA FAVORITOS </span>
                    </h4>
                    <ul class="nav flex-column">
                        <li>mascotica</li>
                        <li>mascotica 2</li>
                        <li>mascotica 3</li>
                        <li>mascotica 4</li>
                        <li>mascotica 5</li>
                    </ul>
                </div>
            </nav> -->


            <div class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                <div class="container">
                    <a type="button" class="btn btn-secondary mb-4 mt-2" href="{{ route('walker.index') }}"><i
                            class="far fa-hand-point-left"></i> Volver</a>
                    <a>
                        <h1 style="position:static; display:block; margin-left:auto; margin-right:auto;"
                            class="p-1 text-center">Perfil de {{ $user->name . ' ' . $user->lastname }} (Paseador de
                            mascotas)</h1>
                        <img src="/uploads/avatars/{{ $user->avatar }}"
                            style="width:150px; border-radious:50%; display: block; margin-left: auto; margin-right: auto;" />
                    </a>
                    <table class="table table-striped table-hover">
                        <tr>
                            <th scope="col">Full Name</th>
                            <td>{{ $user->name . ' ' . $user->lastname }}</td>
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
                            <th scope="col">Slogan</th>
                            <td>{{ $walker->slogan }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Experience</th>
                            <td>{{ $walker->experience }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Creado en</th>
                            <td>{{ $walker->created_at ?? 'Desconocida' }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Actualizado en</th>
                            <td>{{ $walker->updated_at ?? 'Desconocida' }}</td>
                        </tr>
                    </table>
                    <h3>Tus rutas</h3>
                    {{--Rutas del paseador--}}
                    <table class="table table-striped table-hover">
                        <tr>
                            <th scope="col">Ruta</th>
                            <th scope="col">Descripción de la ruta</th>
                            <th scope="col">Duración aproximada</th>
                            <th scope="col">Precio por paseo</th>
                            <th scope="col">Horario</th>
                            <th scope="col"><a href="{{ route('route.create') }}" class="btn btn-primary" title="Crear"><i class="fas fa-plus-circle"></i>Crear nueva</a>
                            </th>
                        </tr>

                        @foreach ($routes as $route)
                            <tr>
                                <td>
                                    @if ($route->privacy == 'private')
                                        <i class="fas fa-lock"></i>
                                    @else
                                        <i class="fas fa-lock-open"></i>
                                    @endif
                                    {{$route->title}}
                                </td>
                                <td><textarea disabled>{{$route->description}}</textarea></td>
                                <td>{{$route->duration}} Horas</td>
                                <td>${{$route->price}}(COP)</td>
                                <td><textarea disabled>{{$route->schedule}}</textarea></td>
                                <td>
                                    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                        <div class="btn-group" role="group" aria-label="Link options">
                                            <a href="{{ route('route.show', $route->id) }}" class=" btn btn-info">Ver</a>
                                            <a href="{{ route('route.edit', $route->id) }}" class="btn btn-warning" title="Editar"><i class="far fa-edit"></i>Editar</a>
                                            <form action="{{ route('route.destroy', $route->id) }}" method="post"
                                                onsubmit="return confirm('¿Esta seguro que desea remover esta ruta?')">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class=" btn btn-danger">Borrar</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <h3>Gestiona tus paseos</h3>
                    {{--Paseos--}}
                    <table class="table table-striped table-hover">
                        <tr>
                            <th scope="col"></th>
                            <td><a class="dropdown-item" href="{{ route('walk.walkerIndex') }}">Gestionar todos mis paseos</a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="col"></th>
                            <td><a class="dropdown-item" href="{{ route('walk.walkerIndexPending') }}">Gestionar paseos pendientes</a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="col"></th>
                            <td><a class="dropdown-item" href="{{ route('walk.walkerIndexActive') }}">Gestionar paseos en curso</a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="col"></th>
                            <td><a class="dropdown-item" href="{{ route('walk.walkerIndexFinished') }}">Ver paseos finalizados</a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="col"></th>
                            <td><a class="dropdown-item" href="{{ route('walk.indexRequests') }}">Ver solicitudes disponibles</a>
                            </td>
                        </tr>
                    </table>  
                    <div class="btn-group" role="group" aria-label="Link options">
                        <a href="{{ route('walker.edit', $walker->user_id) }}" class="btn btn-warning" title="Editar"><i class="far fa-edit"></i>Editar{{$user->name}}</a>
                
                        <form action="" {{-- "{{ route('walker.destroy', auth()->user()->document) }}" --}} method="post"
                            onsubmit="return confirm('¿Esta seguro que desea eliminar el perfil?')">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" title="Remover"><i
                                    class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
