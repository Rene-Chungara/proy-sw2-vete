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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150);
            $table->text('descripcion')->nullable();
            $table->string('foto', 255)->nullable();
            $table->string('codigo', 50)->unique();
            $table->integer('stock')->unsigned()->default(0);
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('almacen_id')->constrained('almacens')->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
