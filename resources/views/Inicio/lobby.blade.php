
    @extends('layouts.app')
    @section('content')
        <a href="{{ url('walker') }}" class="btn btn-primary">
            BUSCAR SERVICIOS DE PASEO
        </a>
        <a href="{{ route('store.index')  }}" class="btn btn-primary">
            BUSCAR TIENDAS O VETERINARIAS
        </a>
        {{--<a href="{{ route('products.index') }}" class="btn btn-primary">
            BUSCAR PRODUCTOS O SERVICIOS
        </a> --}}
    @endsection

