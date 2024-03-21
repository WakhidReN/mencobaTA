<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Restaurant;

class RestaurantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Restaurant::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'pic' => $this->faker->word(),
            'pic_phone' => $this->faker->word(),
            'province' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'city' => $this->faker->city(),
            'district' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'village' => $this->faker->regexify('[A-Za-z0-9]{50}'),
        ];
    }
}
