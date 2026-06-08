@extends('layouts.app_authentication')

@section('title', 'Login')

@section('content')
    <div class="login-box" style="width: 450px;">
        <div class="card card-outline card-primary">
            <div class="card-header text-center" style="display: flex; justify-content: center; align-items: center; padding: 20px;">
                <img src="{{ asset('backend/dist/img/logo-pedidos.jpg') }}" alt="logo-pedidos" style="width: 500px; height: auto; display: block; margin: 0 auto;">
            </div>
            <div class="card-body">
                <p class="login-box-msg">{{ __('Log In') }}</p>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                            placeholder="Correo">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password" placeholder="Contraseña">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">{{ __('Acceder') }}</button>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <p class="mb-1 text-center">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">{{ __('¿Olvidaste tu contraseña?') }}</a>
                                @endif
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection