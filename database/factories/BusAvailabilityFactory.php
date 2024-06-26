<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Bu;
use App\Models\BusAvailability;

class BusAvailabilityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BusAvailability::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'bus_id' => Bu::factory(),
            'status' => $this->faker->randomElement(["Available","Booked","Cancel"]),
            'start_date' => $this->faker->dateTime(),
            'end_date' => $this->faker->dateTime(),
            'payment_status' => $this->faker->randomElement(["Booked - DP","Booked - Non DP","Cancel"]),
            'payment_date' => $this->faker->dateTime(),
            'total_payment' => $this->faker->randomFloat(0, 0, 9999999999.),
        ];
    }
}
