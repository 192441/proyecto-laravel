<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEntregaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'direccion_entrega' => 'required|string',
            'transportadora' => 'nullable|string|max:100',
            'numero_seguimiento' => 'nullable|string|max:100',
            'fecha_entrega_estimada' => 'nullable|date',
            'fecha_entrega_real' => 'nullable|date',
            'recibido_por' => 'nullable|string|max:255',
            'estado_entrega' => 'required|in:Pendiente,En transito,Entregado,Fallido',
        ];
    }

    public function messages()
    {
        return [
            'direccion_entrega.required' => 'La direccion de entrega es obligatoria.',
            'estado_entrega.required' => 'El estado de entrega es obligatorio.',
            'estado_entrega.in' => 'El estado de entrega no es valido.',
        ];
    }
}