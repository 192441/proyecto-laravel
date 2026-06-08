<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistorialEstado extends Model
{
    use HasFactory;

    protected $table = 'historial_estados';
    protected $primaryKey = 'id';
    protected $fillable = [
        'pedido_id',
        'estado_id',
        'fecha_cambio',
        'responsable_id',
        'notas',
        'registradopor'
    ];

    // Relación: Pertenece a un pedido
    public function pedido(): BelongsTo
    {
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }

    // Relación: Pertenece a un estado
    public function estado(): BelongsTo
    {
        return $this->belongsTo(EstadoPedido::class, 'estado_id');
    }

    // Relación: Pertenece al usuario responsable del cambio
    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    // Relación con el usuario que registró
    public function registrador()
    {
        return $this->belongsTo(User::class, 'registradopor');
    }
}