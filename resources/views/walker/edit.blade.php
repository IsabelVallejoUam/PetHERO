
@extends('layouts.app')
@include('layouts.validation-error')
@section('content')
<div class="container">
    
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                
                <div class="card-header">
                    <a type="button" class="btn btn-secondary mb-4 mt-2 " href="{{ url()->previous() }}"><i class="far fa-hand-point-left"></i> Volver</a><br>
                    Editar perfil de {{$user->name}} <i class="fas fa-dog"></i>
                </div>
                       
                <form action="{{ route('walker.update',$user->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card-body">
                         @include('walker.sub_form')
                    </div>
                    <button type="submit" class="btn btn-primary">Editar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

