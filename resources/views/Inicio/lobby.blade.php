
    @extends('layouts.app')
    @section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <a type="button" class="btn btn-secondary mb-4 mt-2" href="{{ url()->previous() }}" style="width:150px;"><i class="far fa-hand-point-left"></i> Volver</a>
                    <div class="card-header row justify-content-center">
                            <img src="/uploads/Logo.png" style="width:150px; border-radious:50%;"/>
                            Peth Hero<br>
                    </div>
                    <div class="card-body row justify-content-center">
                        <a href="{{ url('walker') }}" class="btn btn-primary">
                            <i class="fab fa-searchengin"></i> BUSCAR SERVICIOS DE PASEO
                        </a>
                        <a href="{{ route('store.indexAll') }}" class="btn btn-primary">
                            <i class="fas fa-search-location"></i> BUSCAR TIENDAS O VETERINARIAS
                        </a>
                        <a href="{{ route('forum.index') }}" class="btn btn-primary">
                            <i class="fab fa-wpforms"></i> INGRESAR AL FORO</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
        {{--<a href="{{ route('products.index') }}" class="btn btn-primary">
            BUSCAR PRODUCTOS O SERVICIOS
        </a> --}}
    @endsection

