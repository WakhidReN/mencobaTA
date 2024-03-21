<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Destination;

class DestinationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Destination::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'type' => $this->faker->randomElement(["AA","AO","LL","AR","DO","N"]),
            'marketing_name' => $this->faker->word(),
            'phone_number' => $this->faker->phoneNumber(),
            'weekday_rate' => $this->faker->randomFloat(0, 0, 9999999999.),
            'weekend_rate' => $this->faker->randomFloat(0, 0, 9999999999.),
            'high_season_rate' => $this->faker->randomFloat(0, 0, 9999999999.),
        ];
    }
}
