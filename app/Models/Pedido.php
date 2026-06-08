<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'codigo_pedido',
        'cliente_id',
        'fecha_pedido',
        'total',
        'estado_actual_id',
        'registradopor'
    ];

    // Relación: Un pedido pertenece a un cliente
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    // Relación: Un pedido tiene un estado actual
    public function estadoActual(): BelongsTo
    {
        return $this->belongsTo(EstadoPedido::class, 'estado_actual_id');
    }

    // Relación: Un pedido tiene muchos registros en el historial
    public function historialEstados(): HasMany
    {
        return $this->hasMany(HistorialEstado::class, 'pedido_id');
    }

    // Relación: Un pedido tiene una entrega asociada (1:1)
    public function entrega(): HasOne
    {
        return $this->hasOne(Entrega::class, 'pedido_id');
    }

    // Relación con el usuario que registró
    public function registrador()
    {
        return $this->belongsTo(User::class, 'registradopor');
    }
}