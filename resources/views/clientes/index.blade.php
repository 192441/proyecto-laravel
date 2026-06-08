@extends('layouts.app')

@section('title', 'Listado De Clientes')

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
                            <a href="{{ route('clientes.exportar.excel') }}" class="btn btn-success float-right mr-2" title="Exportar a Excel">
                                <i class="fas fa-file-excel"></i> Excel
                            </a>
                            <a href="{{ route('clientes.create') }}" class="btn btn-primary float-right" title="Nuevo Cliente">
                                <i class="fas fa-plus nav-icon"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            <table id="tabla-clientes" class="table table-bordered table-hover" style="width:100%">
                                <thead class="text-primary">
                                    <th width="10px">ID</th>
                                    <th width="60px">Imagen</th>
                                    <th>Nombre</th>
                                    <th>Documento</th>
                                    <th>Email</th>
                                    <th>Teléfono</th>
                                    <th>Dirección</th>
                                    <th>Registrado por</th>
                                    <th width="60px">Estado</th>
                                    <th width="90px">Acción</th>
                                </thead>
                                <tbody>
                                    @foreach($clientes as $cliente)
                                    <tr>
                                        <td>{{ $cliente->id }}</td>
                                        <td>
                                            @if($cliente->imagen)
                                                <img src="{{ asset($cliente->imagen) }}" alt="{{ $cliente->nombre }}" style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">
                                            @else
                                                <i class="fas fa-user-circle" style="font-size: 30px; color: #cbd5e0;"></i>
                                            @endif
                                        </td>
                                        <td>{{ $cliente->nombre }}</td>
                                        <td>{{ $cliente->documento }}</td>
                                        <td>{{ $cliente->email }}</td>
                                        <td>{{ $cliente->telefono }}</td>
                                        <td>{{ $cliente->direccion }}</td>
                                        <td>{{ $cliente->registrador->name ?? 'N/A' }}</td>
                                        <td>
                                            <input data-type="cliente" data-id="{{ $cliente->id }}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" 
                                            data-toggle="toggle" data-on="Activo" data-off="Inactivo" {{ $cliente->estado == '1' ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-info btn-sm" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                            <form class="d-inline delete-form" action="{{ route('clientes.destroy', $cliente->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            <table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection