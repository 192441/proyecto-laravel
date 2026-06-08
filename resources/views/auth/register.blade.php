@extends('layouts.app_authentication')

@section('title', 'Registro')

@section('content')
    <div class="register-box" style="width: 500px;">
        <div class="card card-outline card-primary">
            <div class="card-header text-center" style="display: flex; justify-content: center; align-items: center; padding: 20px;">
                <img src="{{ asset('backend/dist/img/logo-pedidos.jpg') }}" alt="logo-pedidos" style="width: 500px; height: auto; display: block; margin: 0 auto;">
            </div>
            <div class="card-body">
                <p class="login-box-msg">Registrar nueva cuenta</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus 
                            placeholder="Nombre completo">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                            name="email" value="{{ old('email') }}" required autocomplete="email" 
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
                            name="password" required autocomplete="new-password" 
                            placeholder="Contraseña">
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
                            name="password_confirmation" required autocomplete="new-password" 
                            placeholder="Confirmar contraseña">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Registrarse</button>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <a href="{{ route('login') }}">← Ya tengo una cuenta</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection