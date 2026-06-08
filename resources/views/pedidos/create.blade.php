@extends('layouts.app')

@section('title','Crear Pedido')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid"></div>
    </section>

    @include('layouts.partial.msg')

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">

                    <div class="card">

                        <div class="card-header bg-secondary">
                            <h3>@yield('title')</h3>
                        </div>

                        <form method="POST" action="{{ route('pedidos.store') }}">
                            @csrf

                            <div class="card-body">

                                <div class="row">

                                    {{-- CLIENTE --}}
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Cliente <strong style="color:red;">(*)</strong></label>
                                            <select name="cliente_id" class="form-control @error('cliente_id') is-invalid @enderror" required>
                                                <option value="">-- Seleccione cliente --</option>
                                                @foreach($clientes as $cliente)
                                                    <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                                        {{ $cliente->nombre }} - {{ $cliente->documento }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('cliente_id')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- TOTAL --}}
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Total <strong style="color:red;">(*)</strong></label>
                                            <input type="number" name="total" class="form-control @error('total') is-invalid @enderror"
                                                placeholder="Ej: 100000" step="0.01" required
                                                value="{{ old('total') }}">
                                            @error('total')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                            </div>

                            {{-- CAMPOS OCULTOS --}}
                            <input type="hidden" name="fecha_pedido" value="{{ now() }}">
                            <input type="hidden" name="registradopor" value="{{ auth()->id() }}">

                            <div class="card-footer">

                                <div class="row">

                                    <div class="col-lg-2 col-md-3 col-sm-6">
                                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                                            Registrar
                                        </button>
                                    </div>

                                    <div class="col-lg-2 col-md-3 col-sm-6">
                                        <a href="{{ route('pedidos.index') }}"
                                           class="btn btn-danger btn-block btn-flat">
                                            Atrás
                                        </a>
                                    </div>

                                    <div class="col-lg-3 col-md-3 col-sm-6">
                                        <a href="{{ route('clientes.create') }}"
                                           class="btn btn-warning btn-block btn-flat">
                                            + Nuevo Cliente
                                        </a>
                                    </div>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>
            </div>

        </div>
    </section>

</div>

@endsection