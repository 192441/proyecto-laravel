<?php

namespace Database\Factories;

use App\Models\Entrega;
use App\Models\Pedido;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntregaFactory extends Factory
{
    protected $model = Entrega::class;

    public function definition(): array
    {
        return [
            'pedido_id' => Pedido::factory(),
            'direccion_entrega' => $this->faker->address(),
            'fecha_envio' => $this->faker->optional()->dateTime(),
            'imagen_comprobante' => $this->faker->optional()->imageUrl(),
            'fecha_entrega_estimada' => $this->faker->optional()->dateTimeBetween('now', '+10 days'),
            'fecha_entrega_real' => $this->faker->optional()->dateTimeBetween('now', '+15 days'),
            'transportadora' => $this->faker->randomElement(['Servientrega', 'Envia', 'DHL', 'Coordinadora']),
            'numero_seguimiento' => $this->faker->optional()->numerify('##########'),
            'recibido_por' => $this->faker->optional()->name(),
            'estado_entrega' => $this->faker->randomElement(['Pendiente', 'En tránsito', 'Entregado', 'Fallido']),
            'registradopor' => null, // Se asignará desde el seeder
        ];
    }
}
