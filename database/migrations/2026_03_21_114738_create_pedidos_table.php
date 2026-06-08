<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_pedido', 50)->unique();
            $table->unsignedBigInteger('cliente_id');
            $table->dateTime('fecha_pedido');
            $table->decimal('total', 10, 2);
            $table->unsignedBigInteger('estado_actual_id');
            $table->unsignedBigInteger('registradopor');
            $table->timestamps();

            // Claves foráneas
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('restrict');
            $table->foreign('estado_actual_id')->references('id')->on('estados_pedidos')->onDelete('restrict');
            $table->foreign('registradopor')->references('id')->on('users')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};