
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <a type="button" class="btn btn-secondary mb-4 mt-2" href="{{ url()->previous() }}" style="width:150px;"><i class="far fa-hand-point-left"></i> Volver</a>
                <div class="card-header row justify-content-center">
                    
                        <img src="/uploads/Logo.png" style="width:150px; border-radious:50%;"/>
                        Bienvenido a Peth Hero<br>
                </div>
                <div class="card-body row justify-content-center">
                    <a href="{{ url('/lobby') }}" class="btn btn-primary">
                        PET HERO
                    </a><br>
                    <a href="{{ url('/login') }}" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt"></i> LOGIN
                    </a>
                    <a href="{{ url('/registerOptions') }}" class="btn btn-primary">
                        <i class="fas fa-file-signature"></i> REGISTER
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

