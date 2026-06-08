<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entregas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pedido_id')->unique(); // Relación 1:1
            $table->text('direccion_entrega');
            $table->dateTime('fecha_envio')->nullable();
            $table->string('imagen_comprobante', 255)->nullable();
            $table->dateTime('fecha_entrega_estimada')->nullable();
            $table->dateTime('fecha_entrega_real')->nullable();
            $table->string('transportadora', 100)->nullable();
            $table->string('numero_seguimiento', 100)->nullable();
            $table->string('recibido_por', 255)->nullable();
            $table->string('estado_entrega', 50)->default('Pendiente');
            $table->unsignedBigInteger('registradopor');
            $table->timestamps();

            // Claves foráneas
            $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('cascade');
            $table->foreign('registradopor')->references('id')->on('users')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('entregas');
    }
};