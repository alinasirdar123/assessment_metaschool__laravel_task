@extends('layouts.auth')

@section('css')
<style>
    body{
        height: 100vh;
        font-family: 'poppinsregular';
    }
    img{
        max-width: 100%;
        height: auto;
    }
    .navbar{
        display: none !important;
    }
    .login-container{
        background-color: #fff;
        padding: 50px;
        box-shadow: 0 0 35px 0 rgb(154 161 171 / 15%);
        border-radius: 5px;
    }
    .container{
        position: relative;
        height: 100vh;
    }
    .login-container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 50%;
    }
    .logo{
        width: 36%;
    }
    .login-btn, .login-btn:hover{
        background-color: #70a450;
        width: 100%;
        padding: 10px 0;
        border: 0px;
        font-family: 'poppinsbold';
    }
    .col-form-label, .form-check-label{
        /* font-family: 'poppinsbold'; */
    }
    @media only screen and (max-width: 767px) {
        .login-container{
            width: 100%;
        }
    }
</style>
@endsection

@section('content')
<div class="container">

    <div class="login-container">
        <div class="text-center mb-5">
            <img class="logo"  src="{{ 'public/img/logo-abacus.png' }}" alt="Logo" />
        </div>
        <div class="text-center mb-5">
            <span style="font-size: 25px;">Abacus SOE</span>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="login" class="col-form-label text-md-right">{{ __('login') }}</label>
                <input id="login" type="login" class="form-control @error('login') is-invalid @enderror" name="login" value="{{ old('login') }}" required autocomplete="login" autofocus>

                @error('login')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror            
            </div>

            <div class="form-group">
                <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- <div class="form-group row">
                <div class="col-md-12 text-right">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div> -->

            <div class="form-group row mb-0">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary login-btn">
                        {{ __('Sign Me In') }}
                    </button>

                    <!-- @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif -->
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
