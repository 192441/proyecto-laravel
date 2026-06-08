@extends('layouts.error')

@section('code', '404')

@section('content')
<div class="error-container">
    <div class="error-header error-404">
        <div class="animation-container">
            <div class="ufo">
                <div class="ufo-body"></div>
                <div class="ufo-dome"></div>
                <div class="ufo-light"></div>
            </div>
            <div class="cow">
                <div class="cow-body">
                    <div class="cow-head">
                        <div class="cow-eye"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="error-code">404</div>
        <div class="exception-type">Excepción: Página no encontrada</div>
    </div>
    
    <div class="error-body">
        <div class="code-line">> SISTEMA: RUTA_NO_ENCONTRADA</div>
        <div class="code-line">> ESTADO: INALCANZABLE</div>
        <div class="code-line">> RECURSO: NO_DISPONIBLE</div>
        
        <div class="error-actions">
            <a href="{{ url('/') }}" class="btn btn-primary">
                <i class="fas fa-terminal"></i> REINICIAR SISTEMA
            </a>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> VOLVER
            </a>
        </div>
    </div>
    
    <div class="footer">
        <i class="fas fa-microchip"></i> SISTEMA DE SEGUIMIENTO V.1.0 | <i class="fas fa-code-branch"></i> PROTOCOLO NEON
    </div>
</div>
@endsection