<?php

namespace App\Exports;

use App\Models\Cliente;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ClientesExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Cliente::with('registrador')->get();
    }

    public function headings(): array
    {
        return [
            'ID', 'Nombre', 'Documento', 'Email', 'Teléfono', 'Dirección',
            'Estado', 'Registrado por', 'Fecha Registro'
        ];
    }

    public function map($cliente): array
    {
        return [
            $cliente->id,
            $cliente->nombre,
            $cliente->documento,
            $cliente->email,
            $cliente->telefono,
            $cliente->direccion,
            $cliente->estado == '1' ? 'Activo' : 'Inactivo',
            $cliente->registrador->name ?? 'N/A',
            $cliente->created_at->format('d/m/Y H:i'),
        ];
    }
}