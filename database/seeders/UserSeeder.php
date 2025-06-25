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
        $faker = Faker::create();

        // Asegúrate de tener al menos un rol
        if (Role::count() === 0) {
            Role::create(['name' => 'admin']);
            Role::create(['name' => 'empleado']);
        }

        $roles = Role::all();

        for ($i = 1; $i <= 70; $i++) {

            $role = $roles->random();

            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'rol_id' => $role->id,
                'remember_token' => Str::random(10),
            ]);

            $user->assignRole($role->name);
        }
    }
}
