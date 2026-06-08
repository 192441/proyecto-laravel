<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Entrega extends Model
{
    use HasFactory;

    protected $table = 'entregas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'pedido_id',
        'direccion_entrega',
        'fecha_envio',
        'imagen_comprobante',
        'fecha_entrega_estimada',
        'fecha_entrega_real',
        'transportadora',
        'numero_seguimiento',
        'recibido_por',
        'estado_entrega',
        'registradopor'
    ];

    // Relación: Una entrega pertenece a un pedido (inversa de 1:1)
    public function pedido(): BelongsTo
    {
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }

    // Relación con el usuario que registró
    public function registrador()
    {
        return $this->belongsTo(User::class, 'registradopor');
    }
}