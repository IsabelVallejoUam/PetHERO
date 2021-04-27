

    @extends('layouts.app')
    @section('content')
        <a href="{{ route('petOwner.create') }}" class="btn btn-primary">
            DUEÑO DE MASCOTAS
        </a>
        <a href="{{ route('walker.create') }}" class="btn btn-primary">
            PASEADOR
        </a>
        <a href="{{ route('storeOwner.create') }}" class="btn btn-primary">
            DUEÑO DE TIENDA
        </a>
    @endsection

