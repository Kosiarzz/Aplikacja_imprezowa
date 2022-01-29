<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(30),
            'date_event' => $this->faker->dateTimeBetween('now','+20 days'),
            'budget' => $this->faker->numberBetween(3000, 100000),
            'user_id' => 2,
            'category_id' => $this->faker->numberBetween(1,4),
        ];
    }
}
