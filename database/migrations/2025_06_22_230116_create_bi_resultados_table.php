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
        Schema::create('bi_resultados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producto_id');
            $table->decimal('eoq', 10, 2)->nullable();
            $table->decimal('rop', 10, 2)->nullable();
            $table->string('clasificacion_abc', 1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bi_resultados');
    }
};
