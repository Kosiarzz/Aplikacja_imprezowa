<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->unique()->word,
            'description' => $this->faker->text(200),
            'people_from' => $this->faker->numberBetween(1,10),
            'people_to' => $this->faker->numberBetween(10,100),
            'business_id' => $this->faker->numberBetween(1,10),
        ];
    }
}
