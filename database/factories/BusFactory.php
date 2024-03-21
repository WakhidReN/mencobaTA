<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Bus;

class BusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bus::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'image' => $this->faker->word(),
            'name' => $this->faker->name(),
            'type' => $this->faker->randomElement(["Big Bus","Medium","Legrest"]),
            'seat_total' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'pic' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'pic_phone' => $this->faker->word(),
        ];
    }
}
