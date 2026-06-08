@extends('layouts.app_authentication')

@section('title', 'Recuperar Contraseña')

@section('content')
    <div class="login-box" style="width: 450px;">
        <div class="card card-outline card-primary">
            <div class="card-header text-center" style="display: flex; justify-content: center; align-items: center; padding: 20px;">
                <img src="{{ asset('backend/dist/img/logo-pedidos.jpg') }}" alt="logo-pedidos" style="width: 500px; height: auto; display: block; margin: 0 auto;">
            </div>
            <div class="card-body">
                <p class="login-box-msg">¿Olvidaste tu contraseña?</p>
                <p class="text-muted text-center">Ingresa tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.</p>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
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

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Enviar enlace de recuperación') }}
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