@extends('layouts.app')
@include('layouts.validation-error')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><a type="button" class="btn btn-secondary mb-4 mt-2 " href="{{ url()->previous() }}"><i class="far fa-hand-point-left"></i> Volver</a><br>
                    Califica este paseo
                </div>
                <form action="{{ route('walk.submitRate') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="calification" class="form-label">Cómo calificas el servicio ofrecido</label>
                            <input type="number" min="0" max="5" class="form-control" id="calification" name="calification">
                        </div>
                        <input type="hidden" name="walk_id" value="{{$walk->id}}" id="walk_id">
                    </div>
                    <button type="submit" class="btn btn-primary">Calificar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection