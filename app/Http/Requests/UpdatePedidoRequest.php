<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePedidoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'cliente_id' => 'required|exists:clientes,id',
            'total' => 'required|numeric|min:0',
            'estado_actual_id' => 'required|exists:estados_pedidos,id',
        ];
    }

    public function messages()
    {
        return [
            'cliente_id.required' => 'Debe seleccionar un cliente.',
            'cliente_id.exists' => 'El cliente seleccionado no existe.',
            'total.required' => 'El total del pedido es obligatorio.',
            'total.numeric' => 'El total debe ser un numero.',
            'estado_actual_id.required' => 'Debe seleccionar un estado.',
            'estado_actual_id.exists' => 'El estado seleccionado no existe.',
        ];
    }
}