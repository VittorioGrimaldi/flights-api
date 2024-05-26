<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Airport>
 */
class AirportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->city() . ' Airport',
            'iata_code' => $this->faker->unique()->regexify('[A-Z]{3}'),
            'icao_code' => $this->faker->unique()->regexify('[A-Z]{4}'),
            'country' => $this->faker->country(),
            'city_id' => $this->faker->numberBetween(1, 100),
            'timezone' => $this->faker->timezone(),
        ];
    }
}
