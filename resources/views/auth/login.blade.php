@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">

        <div class="card-body">
          <h4 class="text-center mt-3 mb-5">
              <span style="border-bottom: solid 5px powderblue;">{{ __('messages.Login') }}</span>
          </h4>
            
          <form method="POST" action="{{ route('login') }}">
              @csrf

            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('messages.E-Mail Address') }}</label>
  
              <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <div class="form-group row  mb-0">
              <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('messages.Password') }}</label>

              <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            
            <div class="form-group row">
              <div class="col-md-6 offset-md-7">            
                @if (Route::has('password.request'))
                <div class="col-md-10 pull-right">
                  <a class="btn btn-link text-muted" style="font-size: 80%"; href="{{ route('password.request') }}">
                    {{ __('messages.Forgot Your Password?') }}
                  </a>
                </div>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-6 offset-md-4">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                  <label class="form-check-label" for="remember">
                      {{ __('messages.Remember Me') }}
                  </label>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <div class="offset-md-5">
                <button type="submit" class="btn-border">
                  {{ __('messages.Login') }}
                </button>
              </div>
            </div>
            
          </div>
        </form>
          
      </div>
    </div>
  </div>
</div>

@endsection
