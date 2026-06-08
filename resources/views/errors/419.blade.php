@extends('layouts.error')

@section('code', '419')

@section('content')
<div class="error-container">
    <div class="error-header error-419">
        <div class="animation-container">
            <div class="clock">
                <div class="clock-hand hand-1"></div>
                <div class="clock-hand hand-2"></div>
            </div>
            <div style="position: absolute; right: 20px; top: 40%; font-size: 35px;">⏰</div>
        </div>
        <div class="error-code">419</div>
        <div class="exception-type">Excepción: Sesión Expirada</div>
    </div>
    
    <div class="error-body">
        <div class="code-line">> SESIÓN_EXPIRADA</div>
        <div class="code-line">> TOKEN: NULO</div>
        <div class="code-line">> VERIFICACIÓN: FALLIDA</div>
        
        <div class="error-actions">
            <a href="{{ url()->current() }}" class="btn btn-primary">
                <i class="fas fa-sync-alt"></i> REINTENTAR
            </a>
            <a href="{{ url('/') }}" class="btn btn-secondary">
                <i class="fas fa-home"></i> INICIO
            </a>
        </div>
    </div>
    
    <div class="footer">
        <i class="fas fa-microchip"></i> SISTEMA DE SEGUIMIENTO V.1.0 | <i class="fas fa-code-branch"></i> PROTOCOLO NEON
    </div>
</div>
@endsection