<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClienteRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('cliente');
        return [
            'nombre' => 'required|string|max:255',
            'documento' => 'required|string|max:50|unique:clientes,documento,' . $id,
            'direccion' => 'required|string',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:clientes,email,' . $id,
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre del cliente es obligatorio.',
            'documento.required' => 'El documento es obligatorio.',
            'documento.unique' => 'Este documento ya esta registrado.',
            'direccion.required' => 'La direccion es obligatoria.',
            'telefono.required' => 'El telefono es obligatorio.',
            'email.required' => 'El correo electronico es obligatorio.',
            'email.email' => 'El correo electronico debe ser valido.',
            'email.unique' => 'Este correo electronico ya esta registrado.',
        ];
    }
}