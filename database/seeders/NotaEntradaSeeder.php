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

        // Verificar que existan proveedores
        $proveedorIds = \App\Models\Proveedor::pluck('id')->toArray();
        if (empty($proveedorIds)) {
            throw new \Exception("Se necesitan proveedores antes de generar notas de entrada. Corre el ProveedorSeeder.");
        }

        // Descripciones realistas para notas de entrada veterinarias
        $descripciones = [
            'Compra mensual de medicamentos básicos',
            'Reposición de stock de alimentos premium',
            'Adquisición de equipos médicos veterinarios',
            'Compra de productos de higiene y cuidado',
            'Restock de medicamentos antibióticos',
            'Pedido especial de productos importados',
            'Compra de emergencia por alta demanda',
            'Renovación de inventario de accesorios',
            'Adquisición de productos para temporada alta',
            'Compra programada de vitaminas y suplementos',
            'Reposición de productos de uso frecuente',
            'Pedido de productos especializados',
            'Compra de fin de mes - stock general',
            'Adquisición de nuevos productos en línea',
            'Restock post inventario mensual'
        ];

        // Precios realistas por tipo de producto (aproximados en bolivianos)
        $preciosReales = [
            // Medicamentos
            'Antibiótico' => ['min' => 25.0, 'max' => 180.0],
            'Antiinflamatorio' => ['min' => 15.0, 'max' => 120.0],
            'Vermífugo' => ['min' => 8.0, 'max' => 45.0],
            'Vitaminas' => ['min' => 12.0, 'max' => 80.0],
            'Colirio' => ['min' => 18.0, 'max' => 65.0],
            
            // Alimentos
            'Alimento' => ['min' => 45.0, 'max' => 350.0],
            'Snacks' => ['min' => 8.0, 'max' => 35.0],
            
            // Accesorios
            'Collar' => ['min' => 35.0, 'max' => 180.0],
            'Correa' => ['min' => 25.0, 'max' => 120.0],
            'Bebedero' => ['min' => 30.0, 'max' => 150.0],
            'Cama' => ['min' => 80.0, 'max' => 450.0],
            'Transportadora' => ['min' => 120.0, 'max' => 680.0],
            
            // Higiene
            'Shampoo' => ['min' => 15.0, 'max' => 85.0],
            'Toallitas' => ['min' => 12.0, 'max' => 40.0],
            'Cortaúñas' => ['min' => 25.0, 'max' => 95.0],
            'Cepillo' => ['min' => 18.0, 'max' => 75.0],
            
            // Equipos médicos
            'Jeringa' => ['min' => 2.0, 'max' => 8.0],
            'Gasas' => ['min' => 5.0, 'max' => 25.0],
            'Vendas' => ['min' => 8.0, 'max' => 35.0],
            'Termómetro' => ['min' => 45.0, 'max' => 180.0],
            
            // Juguetes
            'Pelota' => ['min' => 8.0, 'max' => 45.0],
            'Cuerda' => ['min' => 12.0, 'max' => 35.0],
            'Ratón' => ['min' => 6.0, 'max' => 25.0],
            
            // Otros
            'Arena' => ['min' => 25.0, 'max' => 85.0],
            'Pipeta' => ['min' => 15.0, 'max' => 65.0],
            'Suplemento' => ['min' => 35.0, 'max' => 150.0],
            'Spray' => ['min' => 18.0, 'max' => 75.0],
            'Probióticos' => ['min' => 45.0, 'max' => 180.0]
        ];

        for ($i = 1; $i <= 50; $i++) {
            $fecha = $faker->dateTimeBetween('-6 months', 'now');
            
            $notaEntrada = NotaEntrada::create([
                'fecha' => $fecha,
                'monto' => 0,
                'descripcion' => $faker->randomElement($descripciones),
                'proveedor_id' => $faker->randomElement($proveedorIds),
            ]);

            $total = 0;
            // Seleccionar número de productos con probabilidades ponderadas
            $rand = $faker->numberBetween(1, 100);
            if ($rand <= 10) {
                $numProductos = 1; // 10% probabilidad
            } elseif ($rand <= 35) {
                $numProductos = 2; // 25% probabilidad
            } elseif ($rand <= 70) {
                $numProductos = 3; // 35% probabilidad
            } elseif ($rand <= 90) {
                $numProductos = 4; // 20% probabilidad
            } else {
                $numProductos = 5; // 10% probabilidad
            }
            
            $productosUsados = [];
            $productos = \App\Models\Producto::all();
            
            for ($j = 1; $j <= $numProductos; $j++) {
                do {
                    $producto = $productos->random();
                } while (in_array($producto->id, $productosUsados));

                $productosUsados[] = $producto->id;
                
                // Cantidad más realista según el tipo de producto
                $cantidad = $this->getCantidadRealista($producto->nombre, $faker);
                
                // Precio más realista según el tipo de producto
                $precio = $this->getPrecioRealista($producto->nombre, $preciosReales, $faker);
                
                $subtotal = $precio * $cantidad;
                $total += $subtotal;

                DetalleNotaEntrada::create([
                    'nota_entrada_id' => $notaEntrada->id,
                    'producto_id' => $producto->id,
                    'cantidad' => $cantidad,
                    'precio_unitario' => $precio,
                    'subtotal' => $subtotal,
                ]);

                // Actualizar stock del producto (simular entrada de mercancía)
                $producto->increment('stock', $cantidad);
            }

            $notaEntrada->update(['monto' => $total]);
        }
    }

    private function getCantidadRealista($nombreProducto, $faker)
    {
        $nombreLower = strtolower($nombreProducto);
        
        // Medicamentos: cantidades menores
        if (str_contains($nombreLower, 'antibiótico') || 
            str_contains($nombreLower, 'meloxicam') || 
            str_contains($nombreLower, 'colirio') ||
            str_contains($nombreLower, 'vitaminas')) {
            return $faker->numberBetween(5, 25);
        }
        
        // Alimentos: cantidades medianas
        if (str_contains($nombreLower, 'alimento') || 
            str_contains($nombreLower, 'premium') ||
            str_contains($nombreLower, 'cachorro')) {
            return $faker->numberBetween(3, 15);
        }
        
        // Equipos médicos pequeños: cantidades altas
        if (str_contains($nombreLower, 'jeringa') || 
            str_contains($nombreLower, 'gasas') ||
            str_contains($nombreLower, 'toallitas')) {
            return $faker->numberBetween(20, 100);
        }
        
        // Accesorios grandes: cantidades pequeñas
        if (str_contains($nombreLower, 'transportadora') || 
            str_contains($nombreLower, 'cama') ||
            str_contains($nombreLower, 'bebedero')) {
            return $faker->numberBetween(1, 8);
        }
        
        // Otros productos: cantidad estándar
        return $faker->numberBetween(3, 20);
    }

    private function getPrecioRealista($nombreProducto, $preciosReales, $faker)
    {
        $nombreLower = strtolower($nombreProducto);
        
        foreach ($preciosReales as $tipo => $rango) {
            if (str_contains($nombreLower, strtolower($tipo))) {
                return $faker->randomFloat(2, $rango['min'], $rango['max']);
            }
        }
        
        // Precio por defecto si no se encuentra el tipo
        return $faker->randomFloat(2, 15.0, 120.0);
    }
}