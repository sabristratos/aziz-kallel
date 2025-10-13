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
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'preferred_contact_method' => fake()->randomElement(['email', 'phone', 'whatsapp']),
            'financial_topics' => fake()->randomElements(
                ['retirement', 'investment', 'insurance', 'savings', 'tax', 'estate'],
                fake()->numberBetween(1, 3)
            ),
            'meeting_type' => fake()->randomElement(['in-person', 'video', 'phone']),
            'preferred_dates' => [
                fake()->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
                fake()->dateTimeBetween('+1 week', '+2 months')->format('Y-m-d'),
            ],
            'time_preference' => fake()->randomElement(['morning', 'afternoon', 'evening']),
            'current_situation' => fake()->sentence(10),
            'specific_goals' => fake()->sentence(15),
            'additional_notes' => fake()->optional()->paragraph(),
            'status' => fake()->randomElement(['pending', 'confirmed', 'cancelled', 'completed']),
        ];
    }
}
