@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('walk.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="minutes_walked" class="col-md-4 col-form-label text-md-right">{{ __('Minutes Walked') }}</label>

                            <div class="col-md-6">
                                <input id="minutes_walked" type="number" class="form-control @error('minutes_walked') is-invalid @enderror" name="minutes_walked" value="{{ old('minutes_walked') }}" autocomplete="minutes_walked" autofocus>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="commentary" class="col-md-4 col-form-label text-md-right">{{ __('Commentary') }}</label>

                            <div class="col-md-6">
                                <input id="commentary" type="text" class="form-control"  name="commentary" value="{{ old('commentary') }}"  autocomplete="commentary" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="walker" class="col-md-4 col-form-label text-md-right">{{ __('Walker') }}</label>
                            <div class="col-md-6">
                                <input id="walker" type="text" class="form-control"  name="walker" value="{{ old('walker') }}"  autocomplete="walker" autofocus>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="validationCustom04" class="form-label">Estado</label>
                            <select class="form-select" id="validationCustom04" name="status" value="{{ old('status', $walk->status ?? "") }}" >
                             
                             
                          <option selected disabled value="">Elegir...</option>
                                <option selected="selected" value="{{ old('status', $walk->status ?? "") }}">{{ old('status', $walk->status ?? "") }} </option>
                            @foreach ($walk as $status) 
                                <option value="{{ $status['estado'] }}">{{ $status['estado'] }}</option>
                            @endforeach 
                              
                        
                            </select>
                            <div class="invalid-feedback">
                              Por favor eliga una Estado valido.
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
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

