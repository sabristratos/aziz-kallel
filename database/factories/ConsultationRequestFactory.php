<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ConsultationRequest>
 */
class ConsultationRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'financial_topics' => fake()->randomElements(
                ['Kennenlernentermin', 'Altersvorsorge', 'Geldanlage', 'Absicherung', 'Immobilienfinanzierung', 'Steueroptimierung', 'Vermögensaufbau', 'Sonstiges'],
                fake()->numberBetween(1, 3)
            ),
            'additional_notes' => fake()->optional()->paragraph(),
            'status' => fake()->randomElement(['pending', 'confirmed', 'cancelled', 'completed']),
        ];
    }
}
