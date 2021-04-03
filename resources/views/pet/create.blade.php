

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="post" action="{{ route('pet.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre del Peludo') }}</label>

                            <div class="col-md-6" style="margin-bottom: 10px;">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="race" class="col-md-4 col-form-label text-md-right">{{ __('Raza') }}</label>

                            <div class="col-md-6" style="margin-bottom: 10px;">
                                <input id="race" type="text" class="form-control @error('race') is-invalid @enderror" name="race" value="{{ old('race') }}" required autocomplete="race">

                                @error('race')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group col" style="margin-bottom: 10px;">
                            <label for="sex" class="col-md-4 col-form-label text-md-right">{{ __('Sexo') }}</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sex" id="sex1" value="f">
                                <label class="form-check-label" for="sex1">
                                    Femenino
                                </label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="role" id="sex2" value="m">
                                <label class="form-check-label" for="sex2">
                                  Masculino
                                </label>
                              </div>
                        </div>

                        <div class="form-group col" style="margin-bottom: 10px;">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Especie') }}</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" id="type1" value="1">
                                <label class="form-check-label" for="type1">
                                    Perro
                                </label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" id="type2" value="2">
                                <label class="form-check-label" for="type2">
                                  Gato
                                </label>
                              </div>
                        </div>
{{-- Fecha Nacimiento DATEPICKER --}}

                        <div class="container">
                              <div class="row form-group">
                                <div class="col-md-2">
                                    Fecha Nacimiento Mascota
                                </div>
                                <div class="col-md-8">
                                  <input type="text" class="form-control datetimepicker" name="birthday"> 
                                </div>
                              </div>                           
                          </div>

                          <div class="form-group col" style="margin-bottom: 10px;">
                            <label for="size" class="col-md-4 col-form-label text-md-right">{{ __('Tamaño') }}</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="size" id="size1" value="1">
                                <label class="form-check-label" for="size1">
                                    Diminuto
                                </label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="size" id="size2" value="2">
                                <label class="form-check-label" for="size2">
                                  Pequeño
                                </label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="size" id="size3" value="3">
                                <label class="form-check-label" for="size3">
                                  Mediano
                                </label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="size" id="size4" value="4">
                                <label class="form-check-label" for="size4">
                                  Grande
                                </label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="size" id="size5" value="5">
                                <label class="form-check-label" for="size5">
                                  Gigante
                                </label>
                              </div>
                        </div>

                        <div class="form-group col" style="margin-bottom: 10px;">
                            <label for="personality" class="col-md-4 col-form-label text-md-right">{{ __('Personalidad') }}</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="personality" id="personality1" value="1">
                                <label class="form-check-label" for="personality1">
                                    Calmado
                                </label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="personality" id="personality2" value="2">
                                <label class="form-check-label" for="personality2">
                                  Amigable
                                </label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="personality" id="personality3" value="3">
                                <label class="form-check-label" for="personality3">
                                  Agresivo
                                </label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="personality" id="personality4" value="4">
                                <label class="form-check-label" for="personality4">
                                  Timido
                                </label>
                              </div>
                        </div>

                        <div class="form-group row">
                            <label for="commentary" class="col-md-4 col-form-label text-md-right">{{ __('Comentarios Adicionales') }}</label>

                            <div class="col-md-6" style="margin-bottom: 10px;">
                                <input id="commentary" type="text" class="form-control @error('race') is-invalid @enderror" name="commentary" value="{{ old('commentary') }}" required autocomplete="commentary">

                                @error('commentary')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-6" style="margin-top: 50px;">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
