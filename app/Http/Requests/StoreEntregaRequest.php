<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEntregaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'pedido_id' => 'required|exists:pedidos,id|unique:entregas,pedido_id',
            'direccion_entrega' => 'required|string',
            'transportadora' => 'nullable|string|max:100',
            'numero_seguimiento' => 'nullable|string|max:100',
            'fecha_entrega_estimada' => 'nullable|date',
        ];
    }

    public function messages()
    {
        return [
            'pedido_id.required' => 'Debe seleccionar un pedido.',
            'pedido_id.exists' => 'El pedido seleccionado no existe.',
            'pedido_id.unique' => 'Este pedido ya tiene una entrega asignada.',
            'direccion_entrega.required' => 'La direccion de entrega es obligatoria.',
        ];
    }
}