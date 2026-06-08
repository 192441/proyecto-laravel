<?php

namespace Database\Factories;

use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\EstadoPedido;
use Illuminate\Database\Eloquent\Factories\Factory;

class PedidoFactory extends Factory
{
    protected $model = Pedido::class;

    public function definition(): array
    {
        return [
            'codigo_pedido' => 'PED-' . $this->faker->date('Ymd') . '-' . $this->faker->unique()->numerify('#####'),
            'cliente_id' => Cliente::factory(),
            'fecha_pedido' => $this->faker->dateTimeBetween('-30 days', 'now'),
            'total' => $this->faker->randomFloat(2, 50000, 500000),
            'estado_actual_id' => EstadoPedido::factory(),
            'registradopor' => null, // Se asignará desde el seeder
        ];
    }
}