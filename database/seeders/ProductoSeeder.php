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

        for ($i = 1; $i <= 70; $i++) {
            Producto::create([
                'nombre' => $faker->words(3, true),
                'descripcion' => $faker->sentence,
                'foto' => 'productos/' . $faker->uuid . '.jpg', // ruta ficticia
                'codigo' => strtoupper($faker->unique()->bothify('PROD###??')),
                'stock' => $faker->numberBetween(10, 100),
                'categoria_id' => $faker->randomElement($categoriaIds),
                'almacen_id' => $faker->randomElement($almacenIds),
            ]);
            
        }
    }
}
