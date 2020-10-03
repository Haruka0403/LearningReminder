@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        
        <div class="card-body">
          
          <h4 class="text-center mt-3 mb-5">
            <span style="border-bottom: solid 5px powderblue;">{{ __('messages.Reset Password') }}</span>
          </h4>
          
          <p class="text-center">※登録したメールアドレスへパスワード再発行の手続きをお送りします。</p>
          
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
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

              <div class="form-group row">
                <div class="offset-md-5">
                  <button type="submit" class="btn-border">
                    {{ __('messages.Send Password Reset Link') }}
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
