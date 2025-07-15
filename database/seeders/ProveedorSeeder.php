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
        $faker = Faker::create('es_ES');

        // Proveedores específicos para clínica veterinaria
        $proveedoresVeterinarios = [
            [
                'nombre' => 'VetMed Bolivia',
                'telefono' => '591-3-3456789',
                'correo' => 'ventas@vetmedbolivia.com',
                'ciudad' => 'Santa Cruz',
                'pais' => 'Bolivia'
            ],
            [
                'nombre' => 'Laboratorios Zoetis Andina',
                'telefono' => '591-2-2789456',
                'correo' => 'info@zoetis.com.bo',
                'ciudad' => 'La Paz',
                'pais' => 'Bolivia'
            ],
            [
                'nombre' => 'Distribuidora Pet Care SA',
                'telefono' => '591-4-4567890',
                'correo' => 'pedidos@petcare.com.bo',
                'ciudad' => 'Cochabamba',
                'pais' => 'Bolivia'
            ],
            [
                'nombre' => 'Insumos Veterinarios del Sur',
                'telefono' => '591-4-6234567',
                'correo' => 'ventas@insuvetsur.com',
                'ciudad' => 'Sucre',
                'pais' => 'Bolivia'
            ],
            [
                'nombre' => 'Alimentos Premium Pet',
                'telefono' => '591-3-3789012',
                'correo' => 'distribuidora@premiumpet.bo',
                'ciudad' => 'Santa Cruz',
                'pais' => 'Bolivia'
            ],
            [
                'nombre' => 'Equipos Médicos Veterinarios SRL',
                'telefono' => '591-2-2456789',
                'correo' => 'equipos@vetequipos.com',
                'ciudad' => 'La Paz',
                'pais' => 'Bolivia'
            ],
            [
                'nombre' => 'Royal Canin Bolivia',
                'telefono' => '591-3-3567891',
                'correo' => 'bolivia@royalcanin.com',
                'ciudad' => 'Santa Cruz',
                'pais' => 'Bolivia'
            ],
            [
                'nombre' => 'Farmacia Veterinaria Central',
                'telefono' => '591-2-2678912',
                'correo' => 'farmacia@vetcentral.bo',
                'ciudad' => 'La Paz',
                'pais' => 'Bolivia'
            ],
            [
                'nombre' => 'Purina Pro Plan Distribuidora',
                'telefono' => '591-4-4789023',
                'correo' => 'ventas@purina.com.bo',
                'ciudad' => 'Cochabamba',
                'pais' => 'Bolivia'
            ],
            [
                'nombre' => 'Instrumentos Quirúrgicos Vet',
                'telefono' => '591-3-3890134',
                'correo' => 'quirurgicos@instvet.com',
                'ciudad' => 'Santa Cruz',
                'pais' => 'Bolivia'
            ]
        ];

        // Insertar proveedores específicos
        foreach ($proveedoresVeterinarios as $proveedor) {
            Proveedor::create($proveedor);
        }

        // Tipos de empresas veterinarias para generar datos adicionales
        $tiposEmpresas = [
            'Laboratorios',
            'Distribuidora',
            'Farmacia Veterinaria',
            'Alimentos para Mascotas',
            'Equipos Médicos Veterinarios',
            'Insumos Veterinarios',
            'Productos Pet Care',
            'Medicamentos Veterinarios',
            'Instrumentos Quirúrgicos',
            'Suplementos Animales'
        ];

        $sufijosVet = [
            'Vet', 'Pet', 'Animal', 'Zoo', 'Bio', 'Care', 'Med', 'Plus', 'Pro', 'Elite'
        ];

        $ciudadesBolivia = [
            'Santa Cruz', 'La Paz', 'Cochabamba', 'Sucre', 'Oruro', 'Potosí', 'Tarija', 'Trinidad', 'Cobija'
        ];

        // Generar proveedores adicionales con datos más realistas
        for ($i = 1; $i <= 60; $i++) {
            $tipoEmpresa = $faker->randomElement($tiposEmpresas);
            $sufijo = $faker->randomElement($sufijosVet);
            $ciudad = $faker->randomElement($ciudadesBolivia);
            
            $nombreEmpresa = $tipoEmpresa . ' ' . $sufijo;
            if ($faker->boolean(30)) {
                $nombreEmpresa .= ' ' . $faker->randomElement(['SRL', 'SA', 'LTDA']);
            }

            Proveedor::create([
                'nombre' => $nombreEmpresa,
                'telefono' => '591-' . $faker->numberBetween(2, 7) . '-' . $faker->numerify('#######'),
                'correo' => strtolower(str_replace(' ', '', $sufijo)) . $faker->numberBetween(1, 999) . '@' . $faker->randomElement(['gmail.com', 'hotmail.com', 'veterinaria.com', 'petcare.bo', 'vetmed.com']),
                'ciudad' => $ciudad,
                'pais' => 'Bolivia'
            ]);
        }
    }
}
