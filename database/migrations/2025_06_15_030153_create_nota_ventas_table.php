<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nota_ventas', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fecha');
            $table->decimal('monto', 10, 2);
            $table->foreignId('cliente_id')->constrained()->onDelete('restrict');
            $table->foreignId('usuario_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('tipo_pago_id')->constrained('tipo_pagos')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nota_ventas');
    }
};
