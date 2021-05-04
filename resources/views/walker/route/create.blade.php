@extends('layouts.app')
@include('layouts.validation-error')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><a type="button" class="btn btn-secondary mb-4 mt-2 " href="{{ url()->previous() }}"><i class="far fa-hand-point-left"></i> Volver</a><br>
                    Añadir una ruta para {{Auth::user()->name}}
                 </div>
                <form action="{{ route('route.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        @include('walker.route.sub_form')
                    </div> 
                    <button type="submit" class="btn btn-primary">Crear</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection