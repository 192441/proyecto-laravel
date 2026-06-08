<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('documento', 50)->unique();
            $table->text('direccion');
            $table->string('telefono', 20);
            $table->string('email', 255)->unique();
            $table->string('estado', 1)->default('1'); // 1=activo, 0=inactivo
            $table->unsignedBigInteger('registradopor');
            $table->timestamps();

            // Clave foránea
            $table->foreign('registradopor')->references('id')->on('users')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};