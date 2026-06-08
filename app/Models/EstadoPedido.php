<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EstadoPedido extends Model
{
    use HasFactory;

    protected $table = 'estados_pedidos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre_estado',
        'descripcion',
        'tipo_proceso',
        'color_indicador',
        'registradopor'
    ];

    // Relación: Un estado puede estar en muchos pedidos como estado actual
    public function pedidos(): HasMany
    {
        return $this->hasMany(Pedido::class, 'estado_actual_id');
    }

    // Relación: Un estado puede aparecer en muchos registros del historial
    public function historialEstados(): HasMany
    {
        return $this->hasMany(HistorialEstado::class, 'estado_id');
    }

    // Relación con el usuario que registró
    public function registrador()
    {
        return $this->belongsTo(User::class, 'registradopor');
    }
}