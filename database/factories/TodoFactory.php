<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(),
            'is_complete' => $this->faker->boolean(),
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function complete(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'is_complete' => true,
            ];
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function incomplete(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'is_complete' => false,
            ];
        });
    }
}
