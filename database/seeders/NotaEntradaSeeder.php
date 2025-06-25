<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NotaEntrada;
use App\Models\DetalleNotaEntrada;
use Faker\Factory as Faker;

class NotaEntradaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 200; $i++) {
            $notaEntrada = NotaEntrada::create([
                'fecha' => $faker->dateTimeThisYear,
                'monto' => 0,
                'descripcion' => $faker->sentence,
                'proveedor_id' => $faker->numberBetween(1, 70),
            ]);

            $total = 0;
            $numProductos = rand(1, 5);
            $productosUsados = [];
            for ($j = 1; $j <= $numProductos; $j++) {
                do {
                    $producto = \App\Models\Producto::inRandomOrder()->first();
                } while (in_array($producto->id, $productosUsados));

                $productosUsados[] = $producto->id;
                $cantidad = $faker->numberBetween(1, 10);
                $precio = $faker->randomFloat(2, 10, 100);
                $subtotal = $precio * $cantidad;
                $total += $subtotal;

                DetalleNotaEntrada::create([
                    'nota_entrada_id' => $notaEntrada->id,
                    'producto_id' => $producto->id,
                    'cantidad' => $cantidad,
                    'precio_unitario' => $precio,
                    'subtotal' => $subtotal,
                ]);
            }

            $notaEntrada->update(['monto' => $total]);
        }
    }
}