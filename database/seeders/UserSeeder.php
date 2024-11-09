<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder

{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario administrador
        $admin = User::create([
            'name' => 'Yujra Vargas Guino Elvis',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
        ]);

        $adminRole = Role::where('name', 'Administrador')->first();
        $admin->assignRole($adminRole);

        // Crear usuario empresa
        $empresa = User::create([
            'name' => 'INFOTEL EMPRESA',
            'email' => 'empresa@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
        ]);

        $empresaRole = Role::where('name', 'Empresa')->first();
        $empresa->assignRole($empresaRole);

        // Crear usuario cliente
        $cliente = User::create([
            'name' => 'CLIENTE PRUEBA',
            'names' => 'CLIENTE PRUEBA names',
            'email' => 'usuario@gmail.com',
            'apellido_p' => 'yujra',
            'apellido_m' => 'vargas',
            'dni' => '74349846',
            'direccion' => 'Dirección: Jr. Lampa 594, Cercado de Lima, Lima - Perú',
            'telefono' => '+51 916882598',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
        ]);

        $clienteRole = Role::where('name', 'Postulante')->first();
        $cliente->assignRole($clienteRole);
    }
}
