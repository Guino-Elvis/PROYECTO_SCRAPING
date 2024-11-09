<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Empresa>
 */
class EmpresaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'ra_social' => $this->faker->text(40),
            'ruc' => $this->faker->numberBetween(30, 100),
            'direccion' => $this->faker->text(20),
            'telefono' => $this->faker->numberBetween(9, 100),
            'correo' => $this->faker->unique()->safeEmail(),
            'category_id' => User::all()->random()->id,
            'user_id' => User::all()->random()->id,
        ];
    }
}
