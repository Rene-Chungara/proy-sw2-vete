<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Empleado;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('es_ES'); // Usar locale español

        // Verificar que los roles existan (creados por RoleSeeder)
        if (!Role::where('name', 'admin')->exists() || !Role::where('name', 'empleado')->exists()) {
            throw new \Exception("Se necesitan los roles 'admin' y 'empleado'. Ejecuta RoleSeeder primero.");
        }

        $adminRole = Role::where('name', 'admin')->first();
        $empleadoRole = Role::where('name', 'empleado')->first();

        // Crear usuarios específicos del sistema (administradores y personal clave)
        $usuariosEspecificos = [
            [
                'name' => 'Dr. Carlos Mendoza',
                'email' => 'admin@veterinaria.com',
                'role' => 'admin',
                'password' => 'admin12345'
            ],
            [
                'name' => 'Dra. Ana Rodríguez',
                'email' => 'veterinario@veterinaria.com',
                'role' => 'admin', // Veterinario principal con permisos de admin
                'password' => 'veterinario123'
            ],
            [
                'name' => 'María González',
                'email' => 'recepcion@veterinaria.com',
                'role' => 'empleado',
                'password' => 'recepcion123'
            ]
        ];

        foreach ($usuariosEspecificos as $userData) {
            if (!User::where('email', $userData['email'])->exists()) {
                $role = Role::where('name', $userData['role'])->first();
                
                $user = User::create([
                    'name' => $userData['name'],
                    'email' => $userData['email'],
                    'password' => Hash::make($userData['password']),
                    'email_verified_at' => now(),
                    'rol_id' => $role->id,
                    'remember_token' => Str::random(10),
                ]);

                $user->assignRole($role->name);
            }
        }

        // Personal veterinario con rol admin (veterinarios senior)
        $veterinariosAdmin = [
            'Dr. Roberto Silva', 'Dra. Patricia Morales', 'Dr. Fernando López',
            'Dra. Isabel Herrera', 'Dr. Miguel Torres'
        ];

        // Personal general con rol empleado
        $empleadosVeterinaria = [
            // Asistentes veterinarios
            'Laura Martínez (Asistente)', 'José Pérez (Asistente)', 'Elena Sánchez (Asistente)', 
            'Diego Vargas (Asistente)', 'Claudia Rojas (Asistente)',
            
            // Recepcionistas  
            'Gabriela Cruz (Recepcionista)', 'Valentina Mendez (Recepcionista)', 
            'Lucía Espinoza (Recepcionista)', 'Natalia Guerrero (Recepcionista)',
            
            // Almaceneros
            'Carlos Gutierrez (Almacén)', 'Juan Moreno (Almacén)', 'Ricardo Ávila (Almacén)',
            
            // Cajeros
            'Ana Valdez (Cajera)', 'Mónica Salinas (Cajera)', 'Rosa Pinto (Cajera)',
            
            // Personal de apoyo
            'Sandra Velasco (Limpieza)', 'Carolina Aguilar (Auxiliar)', 'Verónica Zambrana (Auxiliar)',
            'Dra. Carmen Vega (Veterinaria)', 'Dr. Alejandro Ruiz (Veterinario)',
            'Dra. Sofía Ramírez (Veterinaria)', 'Dr. Daniel Flores (Veterinario)',
            'Pablo Jiménez (Asistente)', 'Andrea Castillo (Asistente)', 'Marco Delgado (Asistente)',
            'Camila Ortega (Recepcionista)', 'Daniela Quispe (Recepcionista)', 
            'Paola Mamani (Recepcionista)', 'Fernanda Choque (Recepcionista)',
            'Alberto Rios (Almacén)', 'Sergio Medina (Almacén)', 'Francisco Cordova (Almacén)'
        ];

        // Crear veterinarios con rol admin
        foreach ($veterinariosAdmin as $nombre) {
            $email = $this->generateEmailFromName($nombre, 'vet');
            
            if (!User::where('email', $email)->exists()) {
                $user = User::create([
                    'name' => $nombre,
                    'email' => $email,
                    'password' => Hash::make('password123'),
                    'email_verified_at' => now(),
                    'rol_id' => $adminRole->id,
                    'remember_token' => Str::random(10),
                ]);

                $user->assignRole($adminRole->name);
            }
        }

        // Crear empleados con rol empleado
        foreach ($empleadosVeterinaria as $nombre) {
            $email = $this->generateEmailFromName($nombre, 'emp');
            
            if (!User::where('email', $email)->exists()) {
                $user = User::create([
                    'name' => $nombre,
                    'email' => $email,
                    'password' => Hash::make('password123'),
                    'email_verified_at' => now(),
                    'rol_id' => $empleadoRole->id,
                    'remember_token' => Str::random(10),
                ]);

                $user->assignRole($empleadoRole->name);
            }
        }

        // Crear algunos usuarios adicionales con faker para completar
        for ($i = 1; $i <= 15; $i++) {
            // 70% empleados, 30% admins
            $role = $faker->boolean(70) ? $empleadoRole : $adminRole;
            $firstName = $faker->firstName;
            $lastName = $faker->lastName;
            
            // Agregar título apropiado según el rol
            if ($role->name === 'admin' && $faker->boolean(60)) {
                $title = $faker->boolean(50) ? 'Dr.' : 'Dra.';
                $fullName = $title . ' ' . $firstName . ' ' . $lastName;
            } else {
                $fullName = $firstName . ' ' . $lastName;
                
                // Agregar especialidad para empleados
                $especialidades = ['(Asistente)', '(Recepcionista)', '(Cajero)', '(Auxiliar)', '(Técnico)'];
                if ($faker->boolean(40)) {
                    $fullName .= ' ' . $faker->randomElement($especialidades);
                }
            }
            
            // Generar email único
            $baseEmail = strtolower(str_replace([' ', '.', '(', ')'], '', $firstName . $lastName));
            $email = $baseEmail . $i . '@veterinaria.com';
            
            if (!User::where('email', $email)->exists()) {
                $user = User::create([
                    'name' => $fullName,
                    'email' => $email,
                    'password' => Hash::make('password123'),
                    'email_verified_at' => now(),
                    'rol_id' => $role->id,
                    'remember_token' => Str::random(10),
                ]);

                $user->assignRole($role->name);
            }
        }
    }

    private function generateEmailFromName($fullName, $prefix)
    {
        // Convertir nombre completo a email
        $nameParts = explode(' ', $fullName);
        $firstName = strtolower($nameParts[0]);
        $lastName = isset($nameParts[1]) ? strtolower($nameParts[1]) : '';
        
        // Remover títulos como Dr., Dra.
        $firstName = str_replace(['dr.', 'dra.'], '', $firstName);
        
        // Generar email
        $email = $firstName;
        if ($lastName) {
            $email .= '.' . $lastName;
        }
        
        return $email . '.' . $prefix . '@veterinaria.com';
    }
}
