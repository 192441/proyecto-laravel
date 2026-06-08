@extends('layouts.app')

@section('title', 'Listado De Entregas')

@section('content')

<div class="content-wrapper">
    <section class="content-header" style="text-align: right;">
        <div class="container-fluid">
        </div>
    </section>
    @include('layouts.partial.msg')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-secondary" style="font-size: 1.75rem;font-weight: 500; line-height: 1.2; margin-bottom: 0.5rem;">
                            @yield('title')
                        </div>
                        <div class="card-body">
                            <table id="tabla-entregas" class="table table-bordered table-hover" style="width:100%">
                                <thead class="text-primary">
                                    <th>ID</th>
                                    <th>Código Pedido</th>
                                    <th>Cliente</th>
                                    <th>Dirección Entrega</th>
                                    <th>Transportadora</th>
                                    <th>N° Seguimiento</th>
                                    <th>Fecha Envío</th>
                                    <th>Fecha Estimada</th>
                                    <th>Fecha Real</th>
                                    <th>Recibido por</th>
                                    <th>Estado Entrega</th>
                                    <th>Acción</th>
                                </thead>
                                <tbody>
                                    @foreach($entregas as $entrega)
                                    <tr>
                                        <td>{{ $entrega->id }}</td>
                                        <td>{{ $entrega->pedido->codigo_pedido ?? 'N/A' }}</td>
                                        <td>{{ $entrega->pedido->cliente->nombre ?? 'N/A' }}</td>
                                        <td>{{ $entrega->direccion_entrega }}</td>
                                        <td>{{ $entrega->transportadora ?? 'No asignada' }}</td>
                                        <td>{{ $entrega->numero_seguimiento ?? 'N/A' }}</td>
                                        <td>{{ $entrega->fecha_envio ?? 'N/A' }}</td>
                                        <td>{{ $entrega->fecha_entrega_estimada ?? 'N/A' }}</td>
                                        <td>{{ $entrega->fecha_entrega_real ?? 'N/A' }}</td>
                                        <td>{{ $entrega->recibido_por ?? 'N/A' }}</td>
                                        <td>
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
                                        </td>
                                        <td>
                                            <a href="{{ route('entregas.show', $entrega->id) }}" class="btn btn-info btn-sm" title="Ver">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
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