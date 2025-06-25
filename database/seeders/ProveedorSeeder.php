<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Proveedor;
use Faker\Factory as Faker;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 70; $i++) {
            Proveedor::create([
                'nombre' => $faker->company,
                'telefono' => $faker->phoneNumber,
                'correo' => $faker->unique()->companyEmail,
                'ciudad' => $faker->city,
                'pais' => $faker->country
            ]);
        }
    }
}
