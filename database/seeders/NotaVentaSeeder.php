<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NotaVenta;
use App\Models\DetalleVenta;
use App\Models\Producto;
use Faker\Factory as Faker;

class NotaVentaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 200; $i++) {
            $notaVenta = \App\Models\NotaVenta::create([
                'monto' => 0,
                'fecha' => $faker->dateTimeThisYear,
                'cliente_id' => \App\Models\Cliente::inRandomOrder()->first()->id,
                'usuario_id' => \App\Models\User::inRandomOrder()->first()->id,
                'tipo_pago_id' => \App\Models\TipoPago::inRandomOrder()->first()->id,
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
                $importe = $precio * $cantidad;
                $total += $importe;

                \App\Models\DetalleVenta::create([
                    'nota_venta_id' => $notaVenta->id,
                    'producto_id' => $producto->id,
                    'cantidad' => $cantidad,
                    'precio_venta' => $precio,
                    'importe' => $importe,
                ]);
            }

            $notaVenta->update(['monto' => $total]);
        }
    }
}