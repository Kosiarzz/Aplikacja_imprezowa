<?php

namespace Database\Factories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reservation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date_to' => $this->faker->dateTimeBetween('now','+6 days'),
            'date_from' => $this->faker->dateTimeBetween('-6 days','now'),
            'status' => $this->faker->boolean(50),
            'event_id' => $this->faker->numberBetween(1,10),
            'service_id' => $this->faker->numberBetween(1,50),
            'city_id' => $this->faker->numberBetween(1,10),
        ];
    }
}
