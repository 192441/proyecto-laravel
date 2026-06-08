<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEstadoPedidoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('estado');
        return [
            'nombre_estado' => 'required|string|max:50|unique:estados_pedidos,nombre_estado,' . $id,
            'tipo_proceso' => 'required|string|max:50',
            'color_indicador' => 'required|string|max:7',
            'descripcion' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'nombre_estado.required' => 'El nombre del estado es obligatorio.',
            'nombre_estado.unique' => 'Este estado ya existe.',
            'tipo_proceso.required' => 'El tipo de proceso es obligatorio.',
            'color_indicador.required' => 'El color indicador es obligatorio.',
        ];
    }
}