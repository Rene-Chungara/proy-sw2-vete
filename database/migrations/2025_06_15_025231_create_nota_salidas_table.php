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
        Schema::create('nota_salidas', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fecha');
            $table->decimal('monto', 10, 2);
            $table->text('descripcion');
            $table->foreignId('proveedor_id')->constrained('proveedors')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nota_salidas');
    }
};
