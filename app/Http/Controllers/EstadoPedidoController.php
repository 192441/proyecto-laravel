<?php

namespace App\Http\Controllers;

use App\Models\EstadoPedido;
use App\Http\Requests\StoreEstadoPedidoRequest;
use App\Http\Requests\UpdateEstadoPedidoRequest;
use Illuminate\Http\Request;

class EstadoPedidoController extends Controller
{
    // Mostrar lista de estados
   public function index()
{
    $entregas = Entrega::with(['pedido', 'pedido.cliente', 'registrador'])->get(); // Cambiar paginate(15) a get()
    return view('entregas.index', compact('entregas'));
}

    // Mostrar formulario de creacion
    public function create()
    {
        return view('estados.create');
    }

    // Guardar nuevo estado
    public function store(StoreEstadoPedidoRequest $request)
    {
        $validatedData = $request->validated();
        
        EstadoPedido::create([
            'nombre_estado' => $validatedData['nombre_estado'],
            'descripcion' => $validatedData['descripcion'] ?? null,
            'tipo_proceso' => $validatedData['tipo_proceso'],
            'color_indicador' => $validatedData['color_indicador'],
            'registradopor' => auth()->id(),
        ]);

        return redirect()->route('estados.index')
            ->with('success', 'Estado creado correctamente');
    }

    // Mostrar un estado especifico
    public function show($id)
    {
        $estado = EstadoPedido::findOrFail($id);
        return view('estados.show', compact('estado'));
    }

    // Mostrar formulario de edicion
    public function edit($id)
    {
        $estado = EstadoPedido::findOrFail($id);
        return view('estados.edit', compact('estado'));
    }

    // Actualizar estado
    public function update(UpdateEstadoPedidoRequest $request, $id)
    {
        $estado = EstadoPedido::findOrFail($id);
        $validatedData = $request->validated();
        
        $estado->update($validatedData);

        return redirect()->route('estados.index')
            ->with('success', 'Estado actualizado correctamente');
    }

    // Cambiar estado activo/inactivo
    public function cambioEstado($id)
    {
        // Implementacion segun necesidad
    }

    // Eliminar estado
    public function destroy($id)
    {
        $estado = EstadoPedido::findOrFail($id);
        
        // Verificar si hay pedidos usando este estado
        if ($estado->pedidos()->count() > 0) {
            return redirect()->route('estados.index')
                ->with('error', 'No se puede eliminar el estado porque hay pedidos que lo utilizan.');
        }
        
        $estado->delete();

        return redirect()->route('estados.index')
            ->with('success', 'Estado eliminado correctamente');
    }
}