@extends('layouts.app')

@section('title', 'Detalle del Pedido')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detalle del Pedido</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Panel</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pedidos.index') }}">Pedidos</a></li>
                        <li class="breadcrumb-item active">Detalle</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.partial.msg')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h3 class="card-title">Información del Pedido</h3>
                            <div class="card-tools">
                                <a href="{{ route('pedidos.edit', $pedido->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-pencil-alt"></i> Editar
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong><i class="fas fa-barcode"></i> Código:</strong>
                                    <p>{{ $pedido->codigo_pedido }}</p>
                                </div>
                                <div class="col-md-4">
                                    <strong><i class="fas fa-user"></i> Cliente:</strong>
                                    <p>{{ $pedido->cliente->nombre ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <strong><i class="fas fa-dollar-sign"></i> Total:</strong>
                                    <p>${{ number_format($pedido->total, 2) }}</p>
                                </div>
                                <div class="col-md-4">
                                    <strong><i class="fas fa-tag"></i> Estado Actual:</strong>
                                    <p>
                                        <span class="badge" style="background-color: {{ $pedido->estadoActual->color_indicador ?? '#6c757d' }}; color: white; padding: 5px 10px;">
                                            {{ $pedido->estadoActual->nombre_estado ?? 'Sin estado' }}
                                        </span>
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <strong><i class="fas fa-calendar"></i> Fecha Pedido:</strong>
                                    <p>{{ $pedido->fecha_pedido }}</p>
                                </div>
                                <div class="col-md-4">
                                    <strong><i class="fas fa-user-check"></i> Registrado por:</strong>
                                    <p>{{ $pedido->registrador->name ?? 'N/A' }}</p>
                                </div>
                            </div>

                            <hr>

                            <h4><i class="fas fa-history"></i> Historial de Estados</h4>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Estado</th>
                                        <th>Fecha Cambio</th>
                                        <th>Responsable</th>
                                        <th>Notas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pedido->historialEstados as $registro)
                                    <tr>
                                        <td>
                                            <span class="badge" style="background-color: {{ $registro->estado->color_indicador ?? '#6c757d' }}; color: white;">
                                                {{ $registro->estado->nombre_estado ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td>{{ $registro->fecha_cambio }}</td>
                                        <td>{{ $registro->responsable->name ?? 'N/A' }}</td>
                                        <td>{{ $registro->notas ?? 'Sin observaciones' }}</td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No hay historial registrado</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <hr>

                            <h4><i class="fas fa-truck"></i> Información de Entrega</h4>
                            @if($pedido->entrega)
                                <div class="row">
                                    <div class="col-md-4">
                                        <strong>Transportadora:</strong>
                                        <p>{{ $pedido->entrega->transportadora ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Número Seguimiento:</strong>
                                        <p>{{ $pedido->entrega->numero_seguimiento ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Estado Entrega:</strong>
                                        <p>{{ $pedido->entrega->estado_entrega ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Dirección Entrega:</strong>
                                        <p>{{ $pedido->entrega->direccion_entrega ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Recibido por:</strong>
                                        <p>{{ $pedido->entrega->recibido_por ?? 'Pendiente' }}</p>
                                    </div>
                                </div>
                            @else
                                <p class="text-muted">No hay información de entrega asociada</p>
                            @endif
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Volver
                            </a>
                            <a href="{{ route('pedidos.cambiarEstado', $pedido->id) }}" class="btn btn-warning">
                                <i class="fas fa-exchange-alt"></i> Cambiar Estado
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection