@extends('layouts.app')
@include('layouts.validation-error')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><a type="button" class="btn btn-secondary mb-4 mt-2 " href="{{ url()->previous() }}"><i class="far fa-hand-point-left"></i> Volver</a><br>
                    @if($type == 'walk')
                        Califica este paseo
                    @elseif($type == 'store')
                        Califica esta tienda
                    @elseif($type == 'product')
                        Califica este producto
                    @endif   
                </div>
                <form action="{{ route('review.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="rate" class="form-label">Cómo calificas el servicio ofrecido</label>
                            <input type="number" min="0" max="5" class="form-control" id="rate" name="rate">
                        </div>

                        <div class="mb-3">
                            <label for="commentary" class="form-label">Añade tus comentarios</label>
                            <input type="text" min="0" max="5" class="form-control" id="commentary" name="commentary">
                        </div>
                        <input type="hidden" name="type" value="{{$type}}" id="type">
                        <input type="hidden" name="walker_id" value="{{$walker_id}}" id="walker_id">
                        <input type="hidden" name="product_id" value="{{$product_id}}" id="product_id">
                        <input type="hidden" name="store_id" value="{{$store_id}}" id="store_id">
                        <input type="hidden" name="walk_id" value="{{$walk_id}}" id="walk_id">
                        
                    </div>
                    <button type="submit" class="btn btn-primary">Calificar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection