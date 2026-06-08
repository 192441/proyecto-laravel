<?php

namespace App\Http\Controllers;

use App\Models\HistorialEstado;
use App\Models\Pedido;
use Illuminate\Http\Request;

class HistorialEstadoController extends Controller
{
    // Mostrar historial de un pedido especifico
    public function index($pedidoId)
    {
        $pedido = Pedido::with(['cliente', 'estadoActual'])->findOrFail($pedidoId);
        $historial = HistorialEstado::with(['estado', 'responsable'])
            ->where('pedido_id', $pedidoId)
            ->orderBy('fecha_cambio', 'desc')
            ->get();
            
        return view('historial.index', compact('pedido', 'historial'));
    }

    // Mostrar historial GENERAL de todos los pedidos (TODOS sin paginación)
    public function general()
    {
        $historial = HistorialEstado::with(['pedido', 'pedido.cliente', 'estado', 'responsable'])
            ->orderBy('fecha_cambio', 'desc')
            ->get();
            
        return view('historial.general', compact('historial'));
    }
}