
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('walk.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="requested_day" class="col-md-4 col-form-label text-md-right">{{ __('Día para el paseo') }}</label>

                            <div class="col-md-6">
                                <input id="requested_day" type="date" class="form-control @error('requested_day') is-invalid @enderror" name="requested_day" value="{{ old('requested_day') }}" required autocomplete="requested_day" autofocus>

                                @error('requested_day')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="min_time" class="col-md-4 col-form-label text-md-right">{{ __('Minimum Time Expected') }}</label>

                            <div class="col-md-6">
                                <input id="min_time" type="number" class="form-control @error('min_time') is-invalid @enderror" name="min_time" value="{{ old('min_time') }}" autocomplete="min_time" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="max_time" class="col-md-4 col-form-label text-md-right">{{ __('Maximum Time Expected') }}</label>

                            <div class="col-md-6">
                                <input id="max_time" type="number" class="form-control @error('max_time') is-invalid @enderror" name="max_time" value="{{ old('max_time') }}" autocomplete="max_time" autofocus>
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
 --}}
 @extends('layouts.app')
 @include('layouts.validation-error')
 @section('content')
 <div class="container">
     <div class="row justify-content-center">
         <div class="col-md-8">
             <div class="card">
                 <div class="card-header"><a type="button" class="btn btn-secondary mb-4 mt-2 " href="{{ url()->previous() }}"><i class="far fa-hand-point-left"></i> Volver</a><br>
                     Pedir paseo a {{$walker->owner->name}}
                  </div>
                 <form action="{{ route('walk.store') }}" method="post" enctype="multipart/form-data">
                     @csrf
                     <div class="card-body">
                         @include('walks.sub_form')
                     </div> 
                     <button type="submit" class="btn btn-primary">Pedir</button>
                 </form>
             </div>
         </div>
     </div>
 </div>
 @endsection

