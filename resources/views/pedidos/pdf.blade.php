<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pedido #{{ $pedido->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 14px; margin: 20px; }
        .header { text-align: center; border-bottom: 2px solid #000; margin-bottom: 20px; }
        .header h2 { margin: 0; }
        .info { margin-bottom: 20px; }
        .info p { margin: 2px 0; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background: #f2f2f2; }
        .total { text-align: right; font-weight: bold; }
        .footer { text-align: center; margin-top: 30px; font-size: 12px; color: #666; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Comprobante de Pedido</h2>
        <p>Fecha de emisión: {{ $fecha }}</p>
    </div>

    <div class="info">
        <p><strong>Pedido N°:</strong> {{ $pedido->codigo_pedido }}</p>
        <p><strong>Cliente:</strong> {{ $pedido->cliente->nombre ?? 'N/A' }}</p>
        <p><strong>Documento:</strong> {{ $pedido->cliente->documento ?? 'N/A' }}</p>
        <p><strong>Dirección:</strong> {{ $pedido->cliente->direccion ?? 'N/A' }}</p>
        <p><strong>Fecha Pedido:</strong> {{ \Carbon\Carbon::parse($pedido->fecha_pedido)->format('d/m/Y H:i') }}</p>
        <p><strong>Estado Actual:</strong> {{ $pedido->estadoActual->nombre_estado ?? 'N/A' }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Producto/Servicio</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Pedido de seguimiento</td>
                <td>1</td>
                <td>${{ number_format($pedido->total, 2) }}</td>
                <td>${{ number_format($pedido->total, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <p class="total">Total: ${{ number_format($pedido->total, 2) }}</p>

    <div class="footer">
        <p>Sistema de Seguimiento de Pedidos</p>
    </div>
</body>
</html>