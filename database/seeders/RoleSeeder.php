<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Administrador']);
        // Role::create(['name' => 'Cliente']);
        Role::create(['name' => 'Postulante']);
        // Role::create(['name' => 'Vendedor']);
        Role::create(['name' => 'Empresa']);
    }
}
