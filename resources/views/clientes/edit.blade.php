@extends('layouts.app')

@section('title', 'Editar Cliente')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar Cliente</h1>
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
                            <h3 class="card-title">Editar Cliente: {{ $cliente->nombre }}</h3>
                        </div>
                        <form method="POST" action="{{ route('clientes.update', $cliente->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre">Nombre Completo <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                                                id="nombre" name="nombre" value="{{ old('nombre', $cliente->nombre) }}" required>
                                            @error('nombre')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="documento">Documento <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('documento') is-invalid @enderror" 
                                                id="documento" name="documento" value="{{ old('documento', $cliente->documento) }}" required>
                                            @error('documento')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Correo Electrónico <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                                id="email" name="email" value="{{ old('email', $cliente->email) }}" required>
                                            @error('email')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="telefono">Teléfono <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('telefono') is-invalid @enderror" 
                                                id="telefono" name="telefono" value="{{ old('telefono', $cliente->telefono) }}" required>
                                            @error('telefono')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="direccion">Dirección <span class="text-danger">*</span></label>
                                            <textarea class="form-control @error('direccion') is-invalid @enderror" 
                                                id="direccion" name="direccion" rows="2" required>{{ old('direccion', $cliente->direccion) }}</textarea>
                                            @error('direccion')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Imagen Actual</label><br>
                                            @if($cliente->imagen)
                                                <img src="{{ asset($cliente->imagen) }}" alt="{{ $cliente->nombre }}" style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%; margin-bottom: 10px;">
                                            @else
                                                <i class="fas fa-user-circle" style="font-size: 50px; color: #cbd5e0;"></i>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="imagen">Cambiar Imagen</label>
                                            <input type="file" class="form-control @error('imagen') is-invalid @enderror" 
                                                id="imagen" name="imagen" accept="image/*">
                                            @error('imagen')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                                <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection