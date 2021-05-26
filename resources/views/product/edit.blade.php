@extends('layouts.app')
@include('layouts.validation-error')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><a type="button" class="btn btn-secondary mb-4 mt-2 " href="{{ url()->previous() }}"><i class="far fa-hand-point-left"></i> Volver</a><br>
                     Editar producto {{$product->name}}
                </div>
                <form action="{{ route('product.update',$product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card-body">
                        @include('product.sub_edit')
                    </div>
                    <button type="submit" class="btn btn-primary">Editar</button>
                </form>
                <p>
                    <form action="{{ route('product.destroy', $product->id) }}" method="post"
                        onsubmit="return confirm('¿Esta seguro que desea remover este Producto?')">
                        @csrf
                        @method('delete')
                        <button type="submit" class=" btn btn-danger">Eliminar</button>
                    </form> 
            </div>
        </div>
    </div>
</div>
@endsection
