<?php

namespace Database\Factories;

use App\Models\HistorialEstado;
use App\Models\Pedido;
use App\Models\EstadoPedido;
use Illuminate\Database\Eloquent\Factories\Factory;

class HistorialEstadoFactory extends Factory
{
    protected $model = HistorialEstado::class;

    public function definition(): array
    {
        return [
            'pedido_id' => Pedido::factory(),
            'estado_id' => EstadoPedido::factory(),
            'fecha_cambio' => $this->faker->dateTimeThisYear(),
            'responsable_id' => null, // Se asignará desde el seeder
            'notas' => $this->faker->optional()->sentence(),
            'registradopor' => null, // Se asignará desde el seeder
        ];
    }
}