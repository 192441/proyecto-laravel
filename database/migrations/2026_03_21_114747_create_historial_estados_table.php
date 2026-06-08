<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('historial_estados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pedido_id');
            $table->unsignedBigInteger('estado_id');
            $table->dateTime('fecha_cambio');
            $table->unsignedBigInteger('responsable_id');
            $table->text('notas')->nullable();
            $table->unsignedBigInteger('registradopor');
            $table->timestamps();

            // Claves foráneas
            $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('cascade');
            $table->foreign('estado_id')->references('id')->on('estados_pedidos')->onDelete('restrict');
            $table->foreign('responsable_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('registradopor')->references('id')->on('users')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historial_estados');
    }
};