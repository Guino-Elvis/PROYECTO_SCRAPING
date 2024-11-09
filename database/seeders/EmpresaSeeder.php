<?php

namespace Database\Seeders;

use App\Models\Empresa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Image;
class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $empresas = Empresa::factory(4)->create();

        foreach ($empresas as $empresa) {
            Image::factory(1)->create([
                'imageable_id' => $empresa->id,
                'imageable_type' => Empresa::class
            ]);
        }
    }
}
