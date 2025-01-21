<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Output>
 */
class OutputFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => $this->faker->name('masculine'),
            'type' => 'cartao_credito',
            'value' => 5000.00,
            'output_date' => '2025-01-01 00:00:00',
            'people_id' => 1,
        ];
    }
}
