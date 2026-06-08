<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    protected $model = Cliente::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name(),
            'documento' => $this->faker->unique()->numerify('##########'),
            'direccion' => $this->faker->address(),
            'telefono' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'estado' => $this->faker->randomElement(['1', '0']),
            'registradopor' => null, // Se asignará desde el seeder
        ];
    }
}