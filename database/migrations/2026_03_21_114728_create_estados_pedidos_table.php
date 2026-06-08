<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estados_pedidos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_estado', 50);
            $table->text('descripcion')->nullable();
            $table->string('tipo_proceso', 50); // inicio, proceso, final
            $table->string('color_indicador', 7); // hex color
            $table->unsignedBigInteger('registradopor');
            $table->timestamps();

            // Clave foránea
            $table->foreign('registradopor')->references('id')->on('users')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estados_pedidos');
    }
};