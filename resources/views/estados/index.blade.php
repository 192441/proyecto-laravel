@extends('layouts.app')

@section('title', 'Historial de Estados del Pedido')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Historial de Estados</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Panel</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pedidos.index') }}">Pedidos</a></li>
                        <li class="breadcrumb-item active">Historial</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.partial.msg')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- Información del Pedido -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-box"></i> Información del Pedido
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <strong>Código:</strong>
                                    <p class="text-primary">{{ $pedido->codigo_pedido }}</p>
                                </div>
                                <div class="col-md-3">
                                    <strong>Cliente:</strong>
                                    <p>{{ $pedido->cliente->nombre ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-3">
                                    <strong>Total:</strong>
                                    <p>${{ number_format($pedido->total, 2) }}</p>
                                </div>
                                <div class="col-md-3">
                                    <strong>Estado Actual:</strong>
                                    <p>
                                        @php
                                            $color = $pedido->estadoActual->color_indicador ?? '#6c757d';
                                        @endphp
                                        <span class="badge" style="background-color: {{ $color }}; color: white; padding: 8px 15px;">
                                            {{ $pedido->estadoActual->nombre_estado ?? 'N/A' }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabla de historial -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-history"></i> Registro de Cambios
                            </h3>
                        </div>
                        <div class="card-body">
                            @if($historial->count() > 0)
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Estado</th>
                                            <th>Fecha y Hora</th>
                                            <th>Responsable</th>
                                            <th>Notas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($historial as $registro)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @php
                                                    $estadoColor = $registro->estado->color_indicador ?? '#6c757d';
                                                @endphp
                                                <span class="badge" style="background-color: {{ $estadoColor }}; color: white; padding: 5px 10px;">
                                                    {{ $registro->estado->nombre_estado ?? 'N/A' }}
                                                </span>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($registro->fecha_cambio)->format('d/m/Y H:i:s') }}</td>
                                            <td>{{ $registro->responsable->name ?? 'N/A' }}</td>
                                            <td>{{ $registro->notas ?? 'Sin observaciones' }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-info text-center">
                                    <i class="fas fa-info-circle"></i> No hay historial de cambios para este pedido.
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="card">
                        <div class="card-body text-center">
                            <a href="{{ route('pedidos.show', $pedido->id) }}" class="btn btn-info">
                                <i class="fas fa-eye"></i> Ver Detalle
                            </a>
                            <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Volver a Pedidos
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection