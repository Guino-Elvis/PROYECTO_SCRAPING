<?php

namespace Database\Factories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OfertaLaboral>
 */
class OfertaLaboralFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => $this->faker->text(40),
            'ubicacion' => $this->faker->unique()->address(),
            'remuneracion' => $this->faker->numberBetween(20, 100),
            'descripcion' => $this->faker->text(100),
            'body' => $this->faker->text(500),
            'fecha_inicio' => now(),
            'fecha_fin' => now(),
            'state' => $this->faker->randomElement([2]),
            'limite_postulante' => $this->faker->numberBetween(0, 40),
            // 'category_id' => User::all()->random()->id,
            'empresa_id' => User::all()->random()->id,
            'user_id' => User::all()->random()->id,
        ];
    }
}
