@extends('layouts.error')

@section('code', '500')

@section('content')
<div class="error-container">
    <div class="error-header error-500">
        <div class="animation-container">
            <div class="explosion">
                <div class="explosion-particle" style="top: 20%; left: 20%; animation-delay: 0s;"></div>
                <div class="explosion-particle" style="top: 30%; left: 60%; animation-delay: 0.2s;"></div>
                <div class="explosion-particle" style="top: 60%; left: 40%; animation-delay: 0.4s;"></div>
                <div class="explosion-particle" style="top: 70%; left: 70%; animation-delay: 0.6s;"></div>
            </div>
            <div class="pulse-ring" style="position: absolute;"></div>
        </div>
        <div class="error-code">500</div>
        <div class="exception-type">Excepción: Error Interno del Servidor</div>
    </div>
    
    <div class="error-body">
        <div class="code-line">> ERROR_INTERNO</div>
        <div class="code-line">> SERVIDOR: COLAPSO</div>
        <div class="code-line">> RECUPERACIÓN: EN_PROGRESO</div>
        
        <div class="error-actions">
            <a href="{{ url()->previous() }}" class="btn btn-primary">
                <i class="fas fa-sync-alt"></i> REINTENTAR
            </a>
            <a href="{{ url('/') }}" class="btn btn-secondary">
                <i class="fas fa-terminal"></i> REINICIAR SISTEMA
            </a>
        </div>
    </div>
    
    <div class="footer">
        <i class="fas fa-microchip"></i> SISTEMA DE SEGUIMIENTO V.1.0 | <i class="fas fa-code-branch"></i> PROTOCOLO NEON
    </div>
</div>
@endsection