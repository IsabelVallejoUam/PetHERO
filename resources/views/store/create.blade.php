@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><a type="button" class="btn btn-secondary mb-4 mt-2 " href="{{ url()->previous() }}"><i class="far fa-hand-point-left"></i> Volver</a><br>
                    Crear una nuevo establecimiento
                </div>
                  <form action="{{ route('store.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        @include('store.sub_form')
                    </div> 
                    <button type="submit" class="btn btn-primary">Crear</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection