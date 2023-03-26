<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class MethodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'route' => '/' . fake()->lastName() . '/' . fake()->lastName() . '/' . fake()->lastName(),
            'method' => fake()->lastName() . fake()->lastName(),
        ];
    }

}
