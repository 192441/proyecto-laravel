<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePedidoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'cliente_id' => 'required|exists:clientes,id',
            'total' => 'required|numeric|min:0.01',
        ];
    }

    public function messages()
    {
        return [
            'cliente_id.required' => 'Debe seleccionar un cliente.',
            'cliente_id.exists' => 'El cliente seleccionado no existe.',
            'total.required' => 'El total del pedido es obligatorio.',
            'total.numeric' => 'El total debe ser un número.',
            'total.min' => 'El total debe ser mayor que 0.',
        ];
    }
}