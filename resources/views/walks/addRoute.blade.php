@extends('layouts.app')
@include('layouts.validation-error')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><a type="button" class="btn btn-secondary mb-4 mt-2 " href="{{ url()->previous() }}"><i class="far fa-hand-point-left"></i> Volver</a><br>
                    Agregar ruta al paseo de {{$walk->owner->name}}
                </div>
                <form action="{{ route('walk.submitNewRoute') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        @include('walks.submitNewRoute')
                    </div>
                    <button type="submit" class="btn btn-primary">Finalizar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection