<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   public function definition(): array
{
    // Prefijos permitidos
    $prefijos = ['19', '20', '21'];

    // Escoge uno al azar
    $prefijo = $this->faker->randomElement($prefijos);

    // Genera los números restantes (4 dígitos)
    $numero = $this->faker->numerify('####');

    return [
        'name' => fake()->name(),
        'email' => fake()->unique()->safeEmail(),
        'email_verified_at' => now(),
        'password' => static::$password ??= Hash::make('password'),
        'remember_token' => Str::random(10),

        // Aquí agregamos la matrícula
        'matricula' => $prefijo . $numero,

        // Valor inicial de créditos
        'creditos' => $this->faker->numberBetween(0, 50),
    ];
}


    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
