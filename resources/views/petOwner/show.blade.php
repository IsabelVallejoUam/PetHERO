@extends('layouts.app')

@section('content')



    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <h2 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>FAVORITOS </span>
                    </h2>
                    <ul class="nav flex-column">
                        <li>TIENDAS</li>
                        <li>PASEADORES</li>
                    </ul>
                    <h4 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span> LISTA FAVORITOS </span>
                    </h4>
                    <ul class="nav flex-column">
                        <li>tienda 1</li>
                        <li>juan Manuel </li>
                        <li>tienda 2</li>
                        <li>tienda 3 </li>
                        <li>tienda 7</li>
                        <li>Zyra </li>
                    </ul>
                </div>
            </nav>


            <div class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                <a type="button" class="btn btn-secondary mb-4 mt-2" href="{{ url()->previous() }}"><i
                        class="far fa-hand-point-left"></i> Volver</a>
                <div class="card">
                    <a>
                        <h1 style="position:static; display:block; margin-left:auto; margin-right:auto;"
                            class="p-1 text-center">Perfil de {{ $user->name . ' ' . $user->lastname }} </h1>
                        <img src="/uploads/avatars/{{ $user->avatar }}"
                            style="width:150px; border-radious:50%; display: block; margin-left: auto; margin-right: auto;" />
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
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}"><br>
                                            <input type="submit" class="pull-right btn btn-sm btn-primary mt-2"
                                                value="Actualizar avatar">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </tr>
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
                            <th scope="col">Address</th>
                            <td>{{ $petOwner->address }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Creado en</th>
                            <td>{{ $petOwner->created_at ?? 'Desconocida' }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Actualizado en</th>
                            <td>{{ $petOwner->updated_at ?? 'Desconocida' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="btn-group" role="group" aria-label="Link options">
                    <a href="{{ route('petOwner.edit', $petOwner->user_id) }}" class="btn btn-warning" title="Editar"><i
                            class="far fa-edit"></i></a>
                    <form action="" {{-- "{{ route('walker.destroy', auth()->user()->document) }}" --}} method="post"
                        onsubmit="return confirm('¿Esta seguro que desea eliminar el perfil?')">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger" title="Remover"><i class="fas fa-trash"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
