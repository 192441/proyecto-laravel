<?php

namespace App\Http\Controllers;

use App\Models\Entrega;
use App\Models\Pedido;
use App\Http\Requests\StoreEntregaRequest;
use App\Http\Requests\UpdateEntregaRequest;

class EntregaController extends Controller
{
    // ✅ Mostrar lista de entregas (solo consulta)
    public function index()
    {
        $entregas = Entrega::with(['pedido', 'pedido.cliente', 'registrador'])
            ->paginate(50);
        return view('entregas.index', compact('entregas'));
    }

    // ✅ Mostrar detalle de una entrega (solo consulta)
    public function show($id)
    {
        $entrega = Entrega::with(['pedido', 'pedido.cliente', 'registrador'])
            ->findOrFail($id);
        return view('entregas.show', compact('entrega'));
    }

    // ❌ No se necesita en un sistema real (comentado)
    // public function create()
    // {
    //     $pedidos = Pedido::whereDoesntHave('entrega')
    //         ->whereHas('estadoActual', function($query) {
    //             $query->whereIn('nombre_estado', ['Pendiente', 'En preparación', 'Despachado', 'En ruta']);
    //         })
    //         ->get();
    //     return view('entregas.create', compact('pedidos'));
    // }

    // ❌ No se necesita en un sistema real (comentado)
    // public function store(StoreEntregaRequest $request)
    // {
    //     // ...
    // }

    // ❌ No se necesita en un sistema real (comentado)
    // public function edit($id)
    // {
    //     $entrega = Entrega::findOrFail($id);
    //     return view('entregas.edit', compact('entrega'));
    // }

    // ❌ No se necesita en un sistema real (comentado)
    // public function update(UpdateEntregaRequest $request, $id)
    // {
    //     // ...
    // }

    // ❌ No se necesita en un sistema real (comentado)
    // public function destroy($id)
    // {
    //     $entrega = Entrega::findOrFail($id);
    //     $entrega->delete();
    //     return redirect()->route('entregas.index')
    //         ->with('success', 'Entrega eliminada correctamente');
    // }

    // ❌ No se necesita en un sistema real (comentado)
    // public function cambioEstado($id)
    // {
    //     // ...
    // }
}