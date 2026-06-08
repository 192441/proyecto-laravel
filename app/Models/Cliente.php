<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'documento',
        'direccion',
        'telefono',
        'email',
        'imagen',
        'estado',
        'registradopor'
    ];

    // Relación: Un cliente tiene muchos pedidos
    public function pedidos(): HasMany
    {
        return $this->hasMany(Pedido::class, 'cliente_id');
    }

    // Relación con el usuario que registró
    public function registrador()
    {
        return $this->belongsTo(User::class, 'registradopor');
    }
}