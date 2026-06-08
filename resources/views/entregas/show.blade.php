@extends('layouts.app')

@section('title', 'Detalle de la Entrega')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detalle de la Entrega</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Panel</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('entregas.index') }}">Entregas</a></li>
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
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Información de la Entrega</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong><i class="fas fa-hashtag"></i> ID:</strong>
                                    <p>{{ $entrega->id }}</p>
                                </div>
                                <div class="col-md-4">
                                    <strong><i class="fas fa-box"></i> Código Pedido:</strong>
                                    <p>{{ $entrega->pedido->codigo_pedido ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <strong><i class="fas fa-user"></i> Cliente:</strong>
                                    <p>{{ $entrega->pedido->cliente->nombre ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-12">
                                    <strong><i class="fas fa-map-marker-alt"></i> Dirección de Entrega:</strong>
                                    <p>{{ $entrega->direccion_entrega }}</p>
                                </div>
                                <div class="col-md-4">
                                    <strong><i class="fas fa-truck"></i> Transportadora:</strong>
                                    <p>{{ $entrega->transportadora ?? 'No asignada' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <strong><i class="fas fa-barcode"></i> Número de Seguimiento:</strong>
                                    <p>{{ $entrega->numero_seguimiento ?? 'No asignado' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <strong><i class="fas fa-chart-line"></i> Estado Entrega:</strong>
                                    <p>
                                        @php
                                            $estadoClass = '';
                                            if ($entrega->estado_entrega == 'Entregado') $estadoClass = 'success';
                                            elseif ($entrega->estado_entrega == 'En tránsito') $estadoClass = 'primary';
                                            elseif ($entrega->estado_entrega == 'Pendiente') $estadoClass = 'warning';
                                            else $estadoClass = 'danger';
                                        @endphp
                                        <span class="badge badge-{{ $estadoClass }}">
                                            {{ $entrega->estado_entrega }}
                                        </span>
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <strong><i class="fas fa-calendar-alt"></i> Fecha Envío:</strong>
                                    <p>{{ $entrega->fecha_envio ?? 'No registrada' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <strong><i class="fas fa-calendar-check"></i> Fecha Entrega Estimada:</strong>
                                    <p>{{ $entrega->fecha_entrega_estimada ?? 'No registrada' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <strong><i class="fas fa-check-circle"></i> Fecha Entrega Real:</strong>
                                    <p>{{ $entrega->fecha_entrega_real ?? 'Pendiente' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong><i class="fas fa-signature"></i> Recibido por:</strong>
                                    <p>{{ $entrega->recibido_por ?? 'Pendiente' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong><i class="fas fa-camera"></i> Comprobante:</strong>
                                    <p>
                                        @if($entrega->imagen_comprobante)
                                            <a href="{{ asset($entrega->imagen_comprobante) }}" target="_blank" class="btn btn-info btn-sm">
                                                <i class="fas fa-image"></i> Ver Comprobante
                                            </a>
                                        @else
                                            <span class="text-muted">Sin comprobante</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <strong><i class="fas fa-user-check"></i> Registrado por:</strong>
                                    <p>{{ $entrega->registrador->name ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong><i class="fas fa-calendar"></i> Fecha Registro:</strong>
                                    <p>{{ $entrega->created_at }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('entregas.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Volver
                            </a>
                            <!-- Sin botones de editar o eliminar -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection