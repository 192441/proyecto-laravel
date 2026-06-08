@extends('layouts.app_authentication')

@section('title', 'Restablecer Contraseña')

@section('content')
    <div class="login-box" style="width: 450px;">
        <div class="card card-outline card-primary">
            <div class="card-header text-center" style="display: flex; justify-content: center; align-items: center; padding: 20px;">
                <img src="{{ asset('backend/dist/img/logo-pedidos.jpg') }}" alt="logo-pedidos" style="width: 500px; height: auto; display: block; margin: 0 auto;">
            </div>
            <div class="card-body">
                <p class="login-box-msg">Restablecer Contraseña</p>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="input-group mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus
                            placeholder="Correo electrónico">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="new-password" placeholder="Nueva contraseña">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input id="password-confirm" type="password" class="form-control"
                            name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar contraseña">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Restablecer contraseña') }}
                            </button>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <a href="{{ route('login') }}">← Volver al inicio de sesión</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection