<?php

namespace Database\Factories;

use App\Models\EstadoPedido;
use Illuminate\Database\Eloquent\Factories\Factory;

class EstadoPedidoFactory extends Factory
{
    protected $model = EstadoPedido::class;

    public function definition(): array
    {
        return [
            'nombre_estado' => $this->faker->word(),
            'descripcion' => $this->faker->sentence(),
            'tipo_proceso' => $this->faker->randomElement(['inicio', 'proceso', 'final']),
            'color_indicador' => $this->faker->hexColor(),
            'registradopor' => null, // Se asignará desde el seeder
        ];
    }
}