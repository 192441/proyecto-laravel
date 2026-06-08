<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Entrega;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $totalPedidos = Pedido::count();
        $totalClientes = Cliente::count();
        $pedidosPendientes = Pedido::whereHas('estadoActual', function($query) {
            $query->where('nombre_estado', 'Pendiente');
        })->count();
        $pedidosEntregados = Pedido::whereHas('estadoActual', function($query) {
            $query->where('nombre_estado', 'Entregado');
        })->count();
        
        $ultimosPedidos = Pedido::with(['cliente', 'estadoActual'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        $entregasPendientes = Entrega::where('estado_entrega', 'Pendiente')->count();
        $entregasEnTransito = Entrega::where('estado_entrega', 'En transito')->count();
        
        return view('home', compact(
            'totalPedidos', 
            'totalClientes', 
            'pedidosPendientes', 
            'pedidosEntregados',
            'ultimosPedidos',
            'entregasPendientes',
            'entregasEnTransito'
        ));
    }
}