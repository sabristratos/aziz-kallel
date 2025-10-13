<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Faq>
 */
class FaqFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question' => [
                'de' => fake()->sentence().'?',
                'ar' => fake()->sentence().'?',
            ],
            'answer' => [
                'de' => fake()->paragraph(3),
                'ar' => fake()->paragraph(3),
            ],
            'is_active' => fake()->boolean(80),
            'order' => fake()->numberBetween(0, 100),
        ];
    }
}
