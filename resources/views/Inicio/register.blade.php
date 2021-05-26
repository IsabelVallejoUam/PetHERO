

    @extends('layouts.app')
    @section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <a type="button" class="btn btn-secondary mb-4 mt-2" href="{{ url()->previous() }}" style="width:150px;"><i class="far fa-hand-point-left"></i> Volver</a>
                    <div class="card-header row justify-content-center">
                            <img src="/uploads/Logo.png" style="width:150px; border-radious:50%;"/>
                           Registro<br>
                    </div>
                    <div class="card-body row justify-content-center">
                        <a href="{{ route('petOwner.create') }}" class="btn btn-primary">
                            <i class="fas fa-paw"></i> DUEÑO DE MASCOTAS
                        </a>
                        <a href="{{ route('walker.create') }}" class="btn btn-primary">
                            <i class="fas fa-dog"></i> PASEADOR
                        </a>
                        <a href="{{ route('storeOwner.create') }}" class="btn btn-primary">
                            <i class="fas fa-store"></i> DUEÑO DE ESTABLECIMIENTO
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    @endsection

