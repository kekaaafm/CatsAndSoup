<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Value>
 */
class ValueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "user" => "Marketing",
            "value" => $this->faker->numberBetween(0,10000),
            "date" => $this->faker->dateTimeBetween("-1 week", "now")
        ];
    }
}
