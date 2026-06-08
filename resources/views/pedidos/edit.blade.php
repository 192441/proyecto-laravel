@extends('layouts.app')

@section('title', 'Editar Pedido')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar Pedido</h1>
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
                            <h3 class="card-title">Editar Pedido: {{ $pedido->codigo_pedido }}</h3>
                        </div>
                        <form method="POST" action="{{ route('pedidos.update', $pedido->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Código del Pedido</label>
                                            <input type="text" class="form-control" value="{{ $pedido->codigo_pedido }}" readonly disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cliente_id">Cliente <span class="text-danger">*</span></label>
                                            <select class="form-control @error('cliente_id') is-invalid @enderror" 
                                                id="cliente_id" name="cliente_id" required>
                                                <option value="">Seleccione un cliente</option>
                                                @foreach($clientes as $cliente)
                                                    <option value="{{ $cliente->id }}" {{ old('cliente_id', $pedido->cliente_id) == $cliente->id ? 'selected' : '' }}>
                                                        {{ $cliente->nombre }} - {{ $cliente->documento }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('cliente_id')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="total">Total del Pedido <span class="text-danger">*</span></label>
                                            <input type="number" step="0.01" class="form-control @error('total') is-invalid @enderror" 
                                                id="total" name="total" value="{{ old('total', $pedido->total) }}" required>
                                            @error('total')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="estado_actual_id">Estado Actual <span class="text-danger">*</span></label>
                                            <select class="form-control @error('estado_actual_id') is-invalid @enderror" 
                                                id="estado_actual_id" name="estado_actual_id" required>
                                                <option value="">Seleccione un estado</option>
                                                @foreach($estados as $estado)
                                                    <option value="{{ $estado->id }}" {{ old('estado_actual_id', $pedido->estado_actual_id) == $estado->id ? 'selected' : '' }}>
                                                        {{ $estado->nombre_estado }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('estado_actual_id')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="notas">Notas del cambio (opcional)</label>
                                            <textarea class="form-control" id="notas" name="notas" rows="2" placeholder="Ej: Se actualizó el estado del pedido..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                                <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection