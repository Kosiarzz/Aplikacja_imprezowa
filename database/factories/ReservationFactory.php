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
            'date' => $this->faker->dateTimeBetween('now','+10 days'),
            'status' => $this->faker->boolean(50),
            'user_id' => $this->faker->numberBetween(1,10),
            'room_id' => $this->faker->numberBetween(1,10),
            'city_id' => $this->faker->numberBetween(1,10),
        ];
    }
}
