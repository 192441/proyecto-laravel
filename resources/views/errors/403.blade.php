@extends('layouts.error')

@section('code', '403')

@section('content')
<div class="error-container">
    <div class="error-header error-403">
        <div class="animation-container">
            <div class="tractor">
                <div class="tractor-body"></div>
                <div class="tractor-wheel wheel-1"></div>
                <div class="tractor-wheel wheel-2"></div>
                <div class="tractor-exhaust"></div>
                <div class="smoke"></div>
            </div>
            <div style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); font-size: 40px; filter: drop-shadow(0 0 5px #ff4444);">🔒</div>
        </div>
        <div class="error-code">403</div>
        <div class="exception-type">Excepción: Acceso Denegado</div>
    </div>
    
    <div class="error-body">
        <div class="code-line">> ACCESO_DENEGADO</div>
        <div class="code-line">> PERMISOS: INSUFICIENTES</div>
        <div class="code-line">> AUTENTICACIÓN: REQUERIDA</div>
        
        <div class="error-actions">
            <a href="{{ url('/') }}" class="btn btn-primary">
                <i class="fas fa-terminal"></i> REINICIAR SISTEMA
            </a>
            <a href="{{ route('login') }}" class="btn btn-secondary">
                <i class="fas fa-key"></i> INICIAR SESIÓN
            </a>
        </div>
    </div>
    
    <div class="footer">
        <i class="fas fa-microchip"></i> SISTEMA DE SEGUIMIENTO V.1.0 | <i class="fas fa-code-branch"></i> PROTOCOLO NEON
    </div>
</div>
@endsection