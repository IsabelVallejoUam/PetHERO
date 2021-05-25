@extends('layouts.app')
@include('layouts.validation-error')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><a type="button" class="btn btn-secondary mb-4 mt-2 " href="{{ url()->previous() }}"><i class="far fa-hand-point-left"></i> Volver</a><br>
                    Rechazar este paseo
                </div>
                <form action="{{ route('walk.submitWalkerCancel') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="minutes" class="form-label">¿Por qué deseas cancelar este paseo? </label>
                            <input type="text" class="form-control" id="reason" name="reason">
                        </div>
                        <input type="hidden" name="walk_id" value="{{$walk->id}}" id="walk_id">
                    </div>
                    <button type="submit" class="btn btn-primary">Cancelar paseo</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection