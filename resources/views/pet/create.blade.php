@extends('layouts.app')
@section('content')
<form action="{{ route('pet.store') }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('POST')
  @include('pet.sub_form')
  <button type="submit" class="btn btn-primary">Crear</button>
</form>
@endsection