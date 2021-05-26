@extends('layouts.app')
@section('content')
<form action="{{ route('location.store') }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('POST')
  @include('location.sub_form')
  <button type="submit" class="btn btn-primary">Crear</button>
</form>
@endsection
