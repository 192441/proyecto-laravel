@extends('layouts.app')

@section('title', 'Historial General de Estados')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Historial General de Estados</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Panel</a></li>
                        <li class="breadcrumb-item active">Historial General</li>
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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-history"></i> Registro de Cambios de Estado
                            </h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Código Pedido</th>
                                        <th>Cliente</th>
                                        <th>Estado</th>
                                        <th>Fecha y Hora</th>
                                        <th>Responsable</th>
                                        <th>Notas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($historial as $registro)
                                    <tr>
                                        <td>{{ $registro->id }}</td>
                                        <td>
                                            <a href="{{ route('pedidos.show', $registro->pedido_id) }}">
                                                {{ $registro->pedido->codigo_pedido ?? 'N/A' }}
                                            </a>
                                        </td>
                                        <td>{{ $registro->pedido->cliente->nombre ?? 'N/A' }}</td>
                                        <td>
                                            @php
                                                $color = $registro->estado->color_indicador ?? '#6c757d';
                                            @endphp
                                            <span class="badge" style="background-color: {{ $color }}; color: white; padding: 5px 10px;">
                                                {{ $registro->estado->nombre_estado ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($registro->fecha_cambio)->format('d/m/Y H:i:s') }}</td>
                                        <td>{{ $registro->responsable->name ?? 'N/A' }}</td>
                                        <td>{{ $registro->notas ?? 'Sin observaciones' }}</td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No hay registros de cambios de estado</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection