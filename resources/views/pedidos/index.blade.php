@extends('layouts.app')

@section('title', 'Listado De Pedidos')

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
                            <a href="{{ route('pedidos.create') }}" class="btn btn-primary float-right" title="Nuevo Pedido"><i class="fas fa-plus nav-icon"></i></a>
                        </div>
                        <div class="card-body">
                            <table id="tabla-pedidos" class="table table-bordered table-hover" style="width:100%">
                                <thead class="text-primary">
                                    <th width="10px">ID</th>
                                    <th>Código</th>
                                    <th>Cliente</th>
                                    <th>Total</th>
                                    <th>Estado Actual</th>
                                    <th>Fecha Pedido</th>
                                    <th width="160px">Acción</th>
                                </thead>
                                <tbody>
                                    @foreach($pedidos as $pedido)
                                    <tr>
                                        <td>{{ $pedido->id }}</td>
                                        <td>{{ $pedido->codigo_pedido }}</td>
                                        <td>{{ $pedido->cliente->nombre ?? 'N/A' }}</td>
                                        <td>${{ number_format($pedido->total, 2) }}</td>
                                        <td>
                                            @php
                                                $color = $pedido->estadoActual->color_indicador ?? '#6c757d';
                                            @endphp
                                            <span class="badge" style="background-color: {{ $color }}; color: white; padding: 5px 10px;">
                                                {{ $pedido->estadoActual->nombre_estado ?? 'Sin estado' }}
                                            </span>
                                        </td>
                                        <td>{{ $pedido->fecha_pedido }}</td>
                                        <td>
                                            <a href="{{ route('pedidos.show', $pedido->id) }}" class="btn btn-info btn-sm" title="Ver"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('pedidos.pdf', $pedido->id) }}" class="btn btn-danger btn-sm" title="PDF"><i class="fas fa-file-pdf"></i></a>
                                            <a href="{{ route('pedidos.edit', $pedido->id) }}" class="btn btn-primary btn-sm" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                            <form class="d-inline delete-form" action="{{ route('pedidos.destroy', $pedido->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Cancelar"><i class="fas fa-times"></i></button>
                                            </form>
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