
    @extends('layouts.app')
    @section('content')
        <a href="{{ url('/home') }}" class="btn btn-primary">
            PET HERO
        </a>
        <a href="{{ url('/login') }}" class="btn btn-primary">
            LOGIN
        </a>
        <a href="{{ url('/registerOptions') }}" class="btn btn-primary">
            REGISTER
        </a>
    @endsection

