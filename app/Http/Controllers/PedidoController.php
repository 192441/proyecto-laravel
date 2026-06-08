<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\EstadoPedido;
use App\Models\HistorialEstado;
use App\Models\Entrega;
use App\Http\Requests\StorePedidoRequest;
use App\Http\Requests\UpdatePedidoRequest;
use PDF;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::with(['cliente', 'estadoActual', 'registrador'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('pedidos.index', compact('pedidos'));
    }

    public function create()
    {
        $clientes = Cliente::where('estado', '1')->get();
        $estados = EstadoPedido::all();
        return view('pedidos.create', compact('clientes', 'estados'));
    }

    public function store(StorePedidoRequest $request)
    {
        $validatedData = $request->validated();
        
        $codigoPedido = 'PED-' . date('Ymd') . '-' . str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);
        
        while (Pedido::where('codigo_pedido', $codigoPedido)->exists()) {
            $codigoPedido = 'PED-' . date('Ymd') . '-' . str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);
        }
        
        $estadoPendiente = EstadoPedido::where('nombre_estado', 'Pendiente')->first();
        
        $pedido = Pedido::create([
            'codigo_pedido' => $codigoPedido,
            'cliente_id' => $validatedData['cliente_id'],
            'fecha_pedido' => now(),
            'total' => $validatedData['total'],
            'estado_actual_id' => $estadoPendiente->id,
            'registradopor' => auth()->id(),
        ]);

        HistorialEstado::create([
            'pedido_id' => $pedido->id,
            'estado_id' => $estadoPendiente->id,
            'fecha_cambio' => now(),
            'responsable_id' => auth()->id(),
            'notas' => 'Pedido creado',
            'registradopor' => auth()->id(),
        ]);

        Entrega::create([
            'pedido_id' => $pedido->id,
            'direccion_entrega' => $pedido->cliente->direccion,
            'estado_entrega' => 'Pendiente',
            'registradopor' => auth()->id(),
        ]);

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido creado correctamente. Código: ' . $codigoPedido);
    }

    public function show($id)
    {
        $pedido = Pedido::with(['cliente', 'estadoActual', 'registrador', 'historialEstados.estado', 'historialEstados.responsable', 'entrega'])
            ->findOrFail($id);
        return view('pedidos.show', compact('pedido'));
    }

    public function edit($id)
    {
        $pedido = Pedido::findOrFail($id);
        
        if ($pedido->estadoActual->nombre_estado == 'Entregado') {
            return redirect()->route('pedidos.index')
                ->with('error', 'No se puede editar un pedido que ya está entregado.');
        }
        
        if ($pedido->estadoActual->nombre_estado == 'Cancelado') {
            return redirect()->route('pedidos.index')
                ->with('error', 'No se puede editar un pedido cancelado.');
        }
        
        $clientes = Cliente::where('estado', '1')->get();
        $estados = EstadoPedido::all();
        return view('pedidos.edit', compact('pedido', 'clientes', 'estados'));
    }

    public function update(UpdatePedidoRequest $request, $id)
    {
        $pedido = Pedido::findOrFail($id);
        
        if ($pedido->estadoActual->nombre_estado == 'Entregado') {
            return redirect()->route('pedidos.index')
                ->with('error', 'No se puede editar un pedido que ya está entregado.');
        }
        
        if ($pedido->estadoActual->nombre_estado == 'Cancelado') {
            return redirect()->route('pedidos.index')
                ->with('error', 'No se puede editar un pedido cancelado.');
        }
        
        $validatedData = $request->validated();
        $estadoAnterior = $pedido->estado_actual_id;
        $nuevoEstado = $validatedData['estado_actual_id'] ?? null;
        
        $pedido->update($validatedData);
        
        if ($nuevoEstado && $estadoAnterior != $nuevoEstado) {
            HistorialEstado::create([
                'pedido_id' => $pedido->id,
                'estado_id' => $nuevoEstado,
                'fecha_cambio' => now(),
                'responsable_id' => auth()->id(),
                'notas' => $request->notas ?? 'Estado actualizado desde edición',
                'registradopor' => auth()->id(),
            ]);
            
            $nuevoEstadoObj = EstadoPedido::find($nuevoEstado);
            if ($nuevoEstadoObj && $nuevoEstadoObj->nombre_estado == 'Entregado') {
                $entrega = Entrega::where('pedido_id', $pedido->id)->first();
                
                if ($entrega) {
                    $entrega->update([
                        'estado_entrega' => 'Entregado',
                        'fecha_entrega_real' => now(),
                        'recibido_por' => $pedido->cliente->nombre,
                    ]);
                } else {
                    Entrega::create([
                        'pedido_id' => $pedido->id,
                        'direccion_entrega' => $pedido->cliente->direccion,
                        'estado_entrega' => 'Entregado',
                        'fecha_entrega_real' => now(),
                        'recibido_por' => $pedido->cliente->nombre,
                        'registradopor' => auth()->id(),
                    ]);
                }
            }
        }

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido actualizado correctamente');
    }

    public function cambiarEstado($id)
    {
        return redirect()->route('pedidos.edit', $id);
    }

    public function actualizarEstado(Request $request, $id)
    {
        $request->validate([
            'estado_id' => 'required|exists:estados_pedidos,id',
            'notas' => 'nullable|string',
        ]);

        $pedido = Pedido::findOrFail($id);
        $nuevoEstadoId = $request->estado_id;
        $nuevoEstado = EstadoPedido::find($nuevoEstadoId);
        
        if ($pedido->estadoActual->nombre_estado == 'Entregado') {
            return redirect()->route('pedidos.index')
                ->with('error', 'Un pedido entregado no puede cambiar de estado.');
        }
        
        if ($pedido->estadoActual->nombre_estado == 'Cancelado') {
            return redirect()->route('pedidos.index')
                ->with('error', 'No se puede cambiar el estado de un pedido cancelado.');
        }
        
        $pedido->estado_actual_id = $nuevoEstadoId;
        $pedido->save();
        
        HistorialEstado::create([
            'pedido_id' => $pedido->id,
            'estado_id' => $nuevoEstadoId,
            'fecha_cambio' => now(),
            'responsable_id' => auth()->id(),
            'notas' => $request->notas ?: 'Estado actualizado',
            'registradopor' => auth()->id(),
        ]);
        
        if ($nuevoEstado->nombre_estado == 'Entregado') {
            $entrega = Entrega::where('pedido_id', $pedido->id)->first();
            
            if ($entrega) {
                $entrega->update([
                    'estado_entrega' => 'Entregado',
                    'fecha_entrega_real' => now(),
                    'recibido_por' => $pedido->cliente->nombre,
                ]);
            } else {
                Entrega::create([
                    'pedido_id' => $pedido->id,
                    'direccion_entrega' => $pedido->cliente->direccion,
                    'estado_entrega' => 'Entregado',
                    'fecha_entrega_real' => now(),
                    'recibido_por' => $pedido->cliente->nombre,
                    'registradopor' => auth()->id(),
                ]);
            }
        }

        return redirect()->route('pedidos.show', $pedido->id)
            ->with('success', 'Estado del pedido actualizado correctamente');
    }

    public function cambioEstado($id)
    {
        // Implementacion segun necesidad
    }

    public function destroy($id)
    {
        $pedido = Pedido::findOrFail($id);
        
        if ($pedido->estadoActual->nombre_estado == 'Entregado') {
            return redirect()->route('pedidos.index')
                ->with('error', 'No se puede cancelar un pedido que ya está entregado.');
        }
        
        if ($pedido->estadoActual->nombre_estado == 'Cancelado') {
            return redirect()->route('pedidos.index')
                ->with('error', 'El pedido ya está cancelado.');
        }
        
        $estadoCancelado = EstadoPedido::where('nombre_estado', 'Cancelado')->first();
        
        if ($estadoCancelado) {
            $pedido->estado_actual_id = $estadoCancelado->id;
            $pedido->save();
            
            HistorialEstado::create([
                'pedido_id' => $pedido->id,
                'estado_id' => $estadoCancelado->id,
                'fecha_cambio' => now(),
                'responsable_id' => auth()->id(),
                'notas' => 'Pedido cancelado',
                'registradopor' => auth()->id(),
            ]);
            
            $entrega = Entrega::where('pedido_id', $pedido->id)->first();
            if ($entrega) {
                $entrega->update(['estado_entrega' => 'Fallido']);
            }
            
            return redirect()->route('pedidos.index')
                ->with('success', 'Pedido cancelado correctamente');
        }
        
        return redirect()->route('pedidos.index')
            ->with('error', 'No se pudo cancelar el pedido');
    }

    public function seguimiento($codigo)
    {
        $pedido = Pedido::with(['cliente', 'estadoActual', 'historialEstados.estado', 'entrega'])
            ->where('codigo_pedido', $codigo)
            ->first();
            
        if (!$pedido) {
            return view('tracking', ['error' => 'Pedido no encontrado']);
        }
        
        return view('seguimiento', compact('pedido'));
    }

    public function reporte()
    {
        $pedidos = Pedido::with(['cliente', 'estadoActual'])->get();
        return view('pedidos.reporte', compact('pedidos'));
    }

    public function generarPDF($id)
    {
        $pedido = Pedido::with(['cliente', 'estadoActual'])->findOrFail($id);
        $data = [
            'pedido' => $pedido,
            'fecha' => now()->format('d/m/Y H:i'),
        ];
        
        $pdf = PDF::loadView('pedidos.pdf', $data)->setPaper('a4', 'portrait');
        return $pdf->stream('pedido-' . $pedido->codigo_pedido . '.pdf');
    }
}