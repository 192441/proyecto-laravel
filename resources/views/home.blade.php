@extends('layouts.app')

@section('title', 'Panel De Control - Seguimiento de Pedidos')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Panel De Control</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Total Clientes -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>30</h3>
                            <p>Total Clientes</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            Más Información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Total Pedidos -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>63</h3>
                            <p>Total Pedidos</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            Más Información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Pedidos Pendientes -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>15</h3>
                            <p>Pedidos Pendientes</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            Más Información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Pedidos Entregados -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>12</h3>
                            <p>Pedidos Entregados</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            Más Información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Fila 2: Entregas -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>10</h3>
                            <p>Entregas Pendientes</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-hourglass-half"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            Más Información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>18</h3>
                            <p>Entregas En Tránsito</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            Más Información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Fila 3: Últimos Pedidos -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Últimos Pedidos</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Cliente</th>
                                        <th>Total</th>
                                        <th>Estado</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>PED-20260321-32080</td>
                                        <td>Víctor Jáquez</td>
                                        <td>$124,562</td>
                                        <td><span class="badge badge-warning">Pendiente</span></td>
                                        <td>2026-03-14</td>
                                    </tr>
                                    <tr>
                                        <td>PED-20260321-96216</td>
                                        <td>Víctor Jáquez</td>
                                        <td>$128,258</td>
                                        <td><span class="badge badge-warning">Pendiente</span></td>
                                        <td>2026-03-08</td>
                                    </tr>
                                    <tr>
                                        <td>PED-20260321-46427</td>
                                        <td>Lic. Sofía Mondragón</td>
                                        <td>$369,991</td>
                                        <td><span class="badge badge-danger">Cancelado</span></td>
                                        <td>2026-03-07</td>
                                    </tr>
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