<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Cliente;
use App\Models\EstadoPedido;
use App\Models\Pedido;
use App\Models\HistorialEstado;
use App\Models\Entrega;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // ==================== 1. CREAR USUARIOS (10 TOTAL) ====================
        $usuariosReales = [
            ['name' => 'Ariani Navarro Quintero', 'email' => 'yanavarroq@ufpso.edu.co', 'password' => Hash::make('password')],
            ['name' => 'Ana Jaime Julio', 'email' => 'avjaimej@ufpso.edu.co', 'password' => Hash::make('password')],
            ['name' => 'Eduardo Avendaño Perez', 'email' => 'eavendanoperez@ufpso.edu.co', 'password' => Hash::make('password')],
        ];
        
        foreach ($usuariosReales as $usuarioData) {
            if (!User::where('email', $usuarioData['email'])->exists()) {
                User::create($usuarioData);
            }
        }
        
        // Crear 7 usuarios adicionales para completar 10
        $existentes = User::count();
        if ($existentes < 10) {
            User::factory(10 - $existentes)->create();
        }
        
        $usuarios = User::all();
        
        // SOLO los usuarios registradores (Ariani, Ana, Eduardo = IDs 1,2,3)
        $usuariosRegistradores = User::whereIn('id', [1, 2, 3])->get();
        $primerUsuario = $usuarios->first();

        $this->command->info('✅ Usuarios creados: ' . User::count());
        $this->command->info('👥 Registradores (solo ustedes 3):');
        foreach ($usuariosRegistradores as $u) {
            $this->command->info('   - ' . $u->name . ' (ID: ' . $u->id . ')');
        }

        // ==================== 2. CREAR ESTADOS ====================
        $estados = [
            ['nombre_estado' => 'Pendiente', 'tipo_proceso' => 'inicio', 'color_indicador' => '#FFA500', 'descripcion' => 'Pedido recibido, esperando procesamiento'],
            ['nombre_estado' => 'En preparación', 'tipo_proceso' => 'proceso', 'color_indicador' => '#3498db', 'descripcion' => 'Pedido en proceso de preparación'],
            ['nombre_estado' => 'Despachado', 'tipo_proceso' => 'proceso', 'color_indicador' => '#9b59b6', 'descripcion' => 'Pedido salió de la bodega'],
            ['nombre_estado' => 'En ruta', 'tipo_proceso' => 'proceso', 'color_indicador' => '#f39c12', 'descripcion' => 'Pedido en camino al destino'],
            ['nombre_estado' => 'Entregado', 'tipo_proceso' => 'final', 'color_indicador' => '#008000', 'descripcion' => 'Pedido entregado al cliente'],
            ['nombre_estado' => 'Cancelado', 'tipo_proceso' => 'final', 'color_indicador' => '#FF0000', 'descripcion' => 'Pedido cancelado'],
        ];

        foreach ($estados as $estado) {
            EstadoPedido::create([
                'nombre_estado' => $estado['nombre_estado'],
                'descripcion' => $estado['descripcion'],
                'tipo_proceso' => $estado['tipo_proceso'],
                'color_indicador' => $estado['color_indicador'],
                'registradopor' => $primerUsuario->id,
            ]);
        }

        $estadoPendiente = EstadoPedido::where('nombre_estado', 'Pendiente')->first();
        $estadoEntregado = EstadoPedido::where('nombre_estado', 'Entregado')->first();
        $estadosList = EstadoPedido::all();

        // ==================== 3. CREAR CLIENTES (SOLO USTEDES 3 REGISTRAN) ====================
        $this->command->info('Creando 30 clientes...');

        $clientesData = [];
        $documentosUsados = [];
        $emailsUsados = [];

        for ($i = 0; $i < 30; $i++) {
            // SOLO usuarios registradores (IDs 1,2,3)
            $usuarioAleatorio = $usuariosRegistradores->random();
            
            do {
                $documento = fake()->numerify('##########');
            } while (in_array($documento, $documentosUsados));
            $documentosUsados[] = $documento;
            
            do {
                $email = fake()->unique()->safeEmail();
            } while (in_array($email, $emailsUsados));
            $emailsUsados[] = $email;
            
            $clientesData[] = [
                'nombre' => fake()->name(),
                'documento' => $documento,
                'direccion' => fake()->address(),
                'telefono' => fake()->phoneNumber(),
                'email' => $email,
                'estado' => fake()->randomElement(['1', '0']),
                'registradopor' => $usuarioAleatorio->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Cliente::insert($clientesData);
        $clientes = Cliente::all();
        $this->command->info('✅ Clientes creados: ' . $clientes->count());

        // ==================== 4. CREAR PEDIDOS ====================
        $codigosUsados = [];

        foreach ($clientes as $cliente) {
            $numPedidos = rand(1, 3);

            for ($i = 0; $i < $numPedidos; $i++) {
                // Registrador puede ser cualquiera de los 10 usuarios
                $usuarioRegistrador = $usuarios->random();
                
                do {
                    $codigoPedido = 'PED-' . date('Ymd') . '-' . str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);
                } while (in_array($codigoPedido, $codigosUsados));
                $codigosUsados[] = $codigoPedido;
                
                $totalPedido = rand(50000, 500000) / 100;
                $fechaPedido = now()->subDays(rand(1, 30));

                $pedido = Pedido::create([
                    'codigo_pedido' => $codigoPedido,
                    'cliente_id' => $cliente->id,
                    'fecha_pedido' => $fechaPedido,
                    'total' => $totalPedido,
                    'estado_actual_id' => $estadoPendiente->id,
                    'registradopor' => $usuarioRegistrador->id,
                ]);

                HistorialEstado::create([
                    'pedido_id' => $pedido->id,
                    'estado_id' => $estadoPendiente->id,
                    'fecha_cambio' => $fechaPedido,
                    'responsable_id' => $usuarioRegistrador->id,
                    'notas' => 'Pedido creado por: ' . $usuarioRegistrador->name,
                    'registradopor' => $usuarioRegistrador->id,
                ]);

                if (rand(1, 100) <= 70) {
                    $estadosIntermedios = $estadosList->where('nombre_estado', '!=', 'Pendiente');
                    $nuevoEstado = $estadosIntermedios->random();
                    $usuarioCambio = $usuarios->random();
                    
                    $pedido->estado_actual_id = $nuevoEstado->id;
                    $pedido->save();

                    $fechaCambio = $fechaPedido->copy()->addDays(rand(1, 15));
                    
                    HistorialEstado::create([
                        'pedido_id' => $pedido->id,
                        'estado_id' => $nuevoEstado->id,
                        'fecha_cambio' => $fechaCambio,
                        'responsable_id' => $usuarioCambio->id,
                        'notas' => 'Estado actualizado a: ' . $nuevoEstado->nombre_estado . ' por: ' . $usuarioCambio->name,
                        'registradopor' => $usuarioCambio->id,
                    ]);

                    if ($nuevoEstado->nombre_estado == 'Entregado') {
                        $usuarioEntrega = $usuarios->random();
                        $imagenesComprobantes = [
                            'img/comprobantes/firma_cliente_1.jpg',
                            'img/comprobantes/firma_cliente_2.jpg',
                            'img/comprobantes/firma_cliente_3.jpg',
                            'img/comprobantes/recibo_entrega_1.jpg',
                            'img/comprobantes/recibo_entrega_2.jpg',
                            'img/comprobantes/comprobante_entrega.jpg',
                            'img/comprobantes/evidencia_entrega.png',
                            'img/comprobantes/entrega_realizada.jpg',
                        ];
                        
                        Entrega::create([
                            'pedido_id' => $pedido->id,
                            'direccion_entrega' => $cliente->direccion,
                            'fecha_envio' => $fechaPedido->copy()->addDays(rand(1, 3)),
                            'imagen_comprobante' => $imagenesComprobantes[array_rand($imagenesComprobantes)],
                            'fecha_entrega_estimada' => $fechaPedido->copy()->addDays(rand(5, 10)),
                            'fecha_entrega_real' => $fechaCambio,
                            'transportadora' => fake()->randomElement(['Servientrega', 'Envia', 'DHL', 'Coordinadora', 'Inter Rapidísimo']),
                            'numero_seguimiento' => 'GUI-' . strtoupper(fake()->bothify('???-#####')),
                            'recibido_por' => $cliente->nombre,
                            'estado_entrega' => 'Entregado',
                            'registradopor' => $usuarioEntrega->id,
                        ]);
                    } elseif ($nuevoEstado->nombre_estado != 'Cancelado') {
                        $usuarioEntrega = $usuarios->random();
                        
                        Entrega::create([
                            'pedido_id' => $pedido->id,
                            'direccion_entrega' => $cliente->direccion,
                            'fecha_envio' => $fechaPedido->copy()->addDays(rand(1, 2)),
                            'imagen_comprobante' => null,
                            'fecha_entrega_estimada' => $fechaPedido->copy()->addDays(rand(5, 10)),
                            'fecha_entrega_real' => null,
                            'transportadora' => fake()->randomElement(['Servientrega', 'Envia', 'DHL', 'Coordinadora', 'Inter Rapidísimo']),
                            'numero_seguimiento' => 'GUI-' . strtoupper(fake()->bothify('???-#####')),
                            'recibido_por' => null,
                            'estado_entrega' => 'En tránsito',
                            'registradopor' => $usuarioEntrega->id,
                        ]);
                    }
                }
            }
        }

        // ==================== 5. REPORTE FINAL ====================
        $this->command->info('✅ ========== SEEDING COMPLETADO ==========');
        $this->command->info('📊 Usuarios creados: ' . User::count());
        $this->command->info('📊 Clientes creados: ' . Cliente::count());
        $this->command->info('📊 Estados creados: ' . EstadoPedido::count());
        $this->command->info('📊 Pedidos creados: ' . Pedido::count());
        $this->command->info('📊 Historial estados creados: ' . HistorialEstado::count());
        $this->command->info('📊 Entregas creadas: ' . Entrega::count());
        
        $this->command->info('👥 Usuarios con nombres reales (registradores de clientes):');
        $usuariosRegistradoresDB = User::whereIn('id', [1, 2, 3])->get();
        foreach ($usuariosRegistradoresDB as $usuario) {
            $this->command->info('   👤 ' . $usuario->name . ' (ID: ' . $usuario->id . ')');
        }
        
        $this->command->info('✅ =======================================');
    }
}