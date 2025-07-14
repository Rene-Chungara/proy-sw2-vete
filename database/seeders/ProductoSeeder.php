<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Almacen;
use Faker\Factory as Faker;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // Asegúrate de tener categorías y almacenes
        $categoriaIds = Categoria::pluck('id')->toArray();
        $almacenIds = Almacen::pluck('id')->toArray();

        if (empty($categoriaIds) || empty($almacenIds)) {
            throw new \Exception("Se necesitan categorías y almacenes antes de generar productos. Corre los seeders respectivos.");
        }

        // Productos veterinarios realistas
        $productosVeterinarios = [
            // Medicamentos
            ['nombre' => 'Antibiótico Amoxicilina 500mg', 'descripcion' => 'Antibiótico de amplio espectro para infecciones bacterianas en mascotas', 'codigo' => 'AMOX001', 'stock' => 45],
            ['nombre' => 'Antiinflamatorio Meloxicam 5mg', 'descripcion' => 'Antiinflamatorio no esteroideo para dolor y artritis canina', 'codigo' => 'MELOX001', 'stock' => 30],
            ['nombre' => 'Vermífugo Praziquantel', 'descripcion' => 'Desparasitante interno para perros y gatos contra tenias', 'codigo' => 'PRAZ001', 'stock' => 60],
            ['nombre' => 'Vitaminas Multivitamínico Plus', 'descripcion' => 'Complejo vitamínico para el desarrollo saludable de mascotas', 'codigo' => 'VIT001', 'stock' => 25],
            ['nombre' => 'Colirio Oftálmico Terramicina', 'descripcion' => 'Antibiótico tópico para infecciones oculares', 'codigo' => 'TERRA001', 'stock' => 35],

            // Alimentos
            ['nombre' => 'Alimento Balanceado Cachorro Premium', 'descripcion' => 'Alimento especializado para cachorros de 2-12 meses', 'codigo' => 'PREM001', 'stock' => 20],
            ['nombre' => 'Alimento Senior Perros +7 años', 'descripcion' => 'Fórmula especializada para perros de edad avanzada', 'codigo' => 'SEN001', 'stock' => 15],
            ['nombre' => 'Alimento Gatos Adultos Pollo', 'descripcion' => 'Alimento balanceado con pollo para gatos adultos', 'codigo' => 'CAT001', 'stock' => 18],
            ['nombre' => 'Snacks Dentales para Perros', 'descripcion' => 'Premios que ayudan a mantener la higiene dental', 'codigo' => 'DENT001', 'stock' => 40],

            // Accesorios
            ['nombre' => 'Collar Antipulgas Seresto Perro', 'descripcion' => 'Collar antipulgas y garrapatas de larga duración', 'codigo' => 'COL001', 'stock' => 22],
            ['nombre' => 'Correa Retráctil 5 metros', 'descripcion' => 'Correa extensible para paseos seguros', 'codigo' => 'COR001', 'stock' => 15],
            ['nombre' => 'Bebedero Automático 2L', 'descripcion' => 'Dispensador de agua automático para mascotas', 'codigo' => 'BEB001', 'stock' => 12],
            ['nombre' => 'Cama Ortopédica Mediana', 'descripcion' => 'Cama con soporte ortopédico para perros medianos', 'codigo' => 'CAMA001', 'stock' => 8],
            ['nombre' => 'Transportadora Pequeña', 'descripcion' => 'Transportadora segura para gatos y perros pequeños', 'codigo' => 'TRANS001', 'stock' => 10],

            // Higiene y cuidado
            ['nombre' => 'Shampoo Antipulgas Natural', 'descripcion' => 'Shampoo con ingredientes naturales contra pulgas', 'codigo' => 'SHAM001', 'stock' => 28],
            ['nombre' => 'Toallitas Húmedas Antibacteriales', 'descripcion' => 'Toallitas para limpieza rápida y desinfección', 'codigo' => 'TOALL001', 'stock' => 35],
            ['nombre' => 'Cortaúñas Profesional', 'descripcion' => 'Cortaúñas de acero inoxidable para mascotas', 'codigo' => 'CORT001', 'stock' => 18],
            ['nombre' => 'Cepillo Desenredante', 'descripcion' => 'Cepillo especializado para pelo largo y enredado', 'codigo' => 'CEP001', 'stock' => 20],

            // Equipos médicos
            ['nombre' => 'Jeringa 10ml Descartable', 'descripcion' => 'Jeringas estériles para aplicación de medicamentos', 'codigo' => 'JER001', 'stock' => 100],
            ['nombre' => 'Gasas Estériles 10x10cm', 'descripcion' => 'Gasas para curación y limpieza de heridas', 'codigo' => 'GAS001', 'stock' => 80],
            ['nombre' => 'Vendas Elásticas 5cm', 'descripcion' => 'Vendas para inmovilización y soporte', 'codigo' => 'VEN001', 'stock' => 50],
            ['nombre' => 'Termómetro Digital Veterinario', 'descripcion' => 'Termómetro de uso veterinario con punta flexible', 'codigo' => 'TERM001', 'stock' => 12],

            // Juguetes
            ['nombre' => 'Pelota de Caucho Dental', 'descripcion' => 'Pelota con textura para limpieza dental', 'codigo' => 'JUG001', 'stock' => 25],
            ['nombre' => 'Cuerda Nudos Algodón', 'descripcion' => 'Juguete de cuerda para mordida y juego', 'codigo' => 'CUER001', 'stock' => 30],
            ['nombre' => 'Ratón de Juguete con Hierba Gatera', 'descripcion' => 'Juguete para gatos con hierba gatera natural', 'codigo' => 'RAT001', 'stock' => 40],

            // Productos adicionales
            ['nombre' => 'Arena Sanitaria Aglomerante 10kg', 'descripcion' => 'Arena higiénica para gatos con control de olores', 'codigo' => 'AREN001', 'stock' => 25],
            ['nombre' => 'Pipeta Antipulgas Grande', 'descripcion' => 'Pipeta antiparasitaria para perros de 20-40kg', 'codigo' => 'PIP001', 'stock' => 35],
            ['nombre' => 'Suplemento Articular Glucosamina', 'descripcion' => 'Suplemento para salud articular en mascotas mayores', 'codigo' => 'GLUC001', 'stock' => 20],
            ['nombre' => 'Spray Cicatrizante', 'descripcion' => 'Spray para acelerar cicatrización de heridas menores', 'codigo' => 'SPRAY001', 'stock' => 22],
            ['nombre' => 'Probióticos para Mascotas', 'descripcion' => 'Suplemento probiótico para salud digestiva', 'codigo' => 'PROB001', 'stock' => 18]
        ];

        foreach ($productosVeterinarios as $producto) {
            Producto::create([
                'nombre' => $producto['nombre'],
                'descripcion' => $producto['descripcion'],
                'foto' => 'productos/' . strtolower(str_replace(' ', '_', $producto['codigo'])) . '.jpg',
                'codigo' => $producto['codigo'],
                'stock' => $producto['stock'],
                'categoria_id' => $faker->randomElement($categoriaIds),
                'almacen_id' => $faker->randomElement($almacenIds),
            ]);
        }

        // Agregar algunos productos adicionales con datos más variados
        for ($i = 1; $i <= 20; $i++) {
            $tipoProducto = $faker->randomElement(['Medicamento', 'Accesorio', 'Alimento', 'Juguete']);
            $nombreBase = $faker->randomElement([
                'Premium',
                'Deluxe',
                'Natural',
                'Eco',
                'Pro',
                'Plus',
                'Special',
                'Advanced'
            ]);

            Producto::create([
                'nombre' => $tipoProducto . ' ' . $nombreBase . ' ' . $faker->numberBetween(1, 99),
                'descripcion' => 'Producto veterinario de calidad para el cuidado de mascotas',
                'foto' => 'productos/' . $faker->uuid . '.jpg',
                'codigo' => strtoupper($faker->unique()->bothify('VET###??')),
                'stock' => $faker->numberBetween(5, 80),
                'categoria_id' => $faker->randomElement($categoriaIds),
                'almacen_id' => $faker->randomElement($almacenIds),
            ]);
        }
    }
}
