<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\EstadoPedidoController;
use App\Http\Controllers\HistorialEstadoController;
use App\Http\Controllers\EntregaController;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Rutas PDF y EXCEL
    Route::get('/clientes/exportar-excel', [ClienteController::class, 'exportarExcel'])->name('clientes.exportar.excel');
    Route::get('/pedidos/{id}/pdf', [PedidoController::class, 'generarPDF'])->name('pedidos.pdf');

    Route::resource('clientes', ClienteController::class);
    Route::resource('pedidos', PedidoController::class);
    Route::resource('estados', EstadoPedidoController::class);
    Route::resource('entregas', EntregaController::class);

    // Rutas de historial
    Route::get('/pedidos/{id}/historial', [HistorialEstadoController::class, 'index'])->name('pedidos.historial');
    Route::get('/historial-general', [HistorialEstadoController::class, 'general'])->name('historial.general');

    Route::get('/pedidos/{id}/cambiar-estado', [PedidoController::class, 'cambiarEstado'])->name('pedidos.cambiarEstado');
    Route::post('/pedidos/{id}/actualizar-estado', [PedidoController::class, 'actualizarEstado'])->name('pedidos.actualizarEstado');

    Route::get('/cambioestadocliente/{id}', [ClienteController::class, 'cambioEstado'])->name('cambioestadocliente');
    Route::get('/cambioestadopedido/{id}', [PedidoController::class, 'cambioEstado'])->name('cambioestadopedido');
    Route::get('/cambioestadoentrega/{id}', [EntregaController::class, 'cambioEstado'])->name('cambioestadoentrega');
    Route::get('/cambioestadoestado/{id}', [EstadoPedidoController::class, 'cambioEstado'])->name('cambioestadoestado');

    Route::get('/seguimiento/{codigo}', [PedidoController::class, 'seguimiento'])->where('codigo', 'PED-[0-9]{8}-[0-9]{5}')->name('seguimiento');
    Route::get('/reporte/pedidos', [PedidoController::class, 'reporte'])->name('reporte.pedidos');
    Route::get('/reporte/clientes', [ClienteController::class, 'reporte'])->name('reporte.clientes');

    // Rutas para probar errores
    Route::get('/error-403', function () { abort(403); });
    Route::get('/error-419', function () { abort(419); });
    Route::get('/error-500', function () { abort(500); });
    Route::get('/error-404', function () { abort(404); });
    Route::get('/test-excel', function() {
        return 'La ruta funciona';
    });
});

Route::get('/tracking/{codigo}', function ($codigo) {
    return view('tracking', ['codigo' => $codigo]);
})->name('tracking');

// ========================================================
// RUTA DE EMERGENCIA PARA MIGRAR EN RENDER (PLAN FREE)
// ========================================================
Route::get('/migrar-base-de-datos-secreta', function () {
    try {
        Artisan::call('migrate', ['--force' => true]);
        return "¡Tablas creadas con éxito en la base de datos de Render!";
    } catch (\Exception $e) {
        return "Error al migrar: " . $e->getMessage();
    }
});