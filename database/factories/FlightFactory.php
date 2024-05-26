<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flight>
 */
class FlightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $departureDatetime = fake()->dateTimeBetween('now', '+1 year');
        $departureDatetime->setTime($departureDatetime->format('H'), 0, 0); // round to the nearest hour
        $interval = '+' . rand(60, 20 * 60) . ' minutes';
        $arrivalDatetime = (clone $departureDatetime)->modify($interval);
        $arrivalDatetime->setTime($arrivalDatetime->format('H'), 0, 0); // round to the nearest hour
        $duration = $arrivalDatetime->diff($departureDatetime);
        $formatted_duration = $duration->format('%H:%I:%S');
        $hours = $duration->h + ($duration->i / 60) + ($duration->s / 3600);
        $average_speed = 1000;
        $distance = $average_speed * $hours;

        return [
            'airline_id' => $this->faker->numberBetween(1, 10),
            'flight_number' => $this->faker->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'status' => $this->faker->randomElement(['scheduled', 'delayed', 'cancelled']),
            'departure_airport' => $this->faker->city(),
            'departure_airport_id' => $this->faker->numberBetween(1, 50),
            'arrival_airport' => $this->faker->city(),
            'arrival_airport_id' => $this->faker->numberBetween(1, 50),
            'departure_datetime' => $departureDatetime,
            'arrival_datetime' => $arrivalDatetime,
            'duration' => $formatted_duration,
            'distance' => $distance,
            'economy_price' => $this->faker->randomFloat(2, 100, 1000),
            'business_price' => rand(1, 100) % 2 ? $this->faker->randomFloat(2, 1000, 10000) : null, // not always present
        ];
    }
}
