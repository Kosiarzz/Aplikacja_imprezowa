<?php

namespace Database\Factories;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Notification::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->faker->sentence, #zdanie
            'status' => $this->faker->boolean(50), #50% true/false
            'shown' => $this->faker->boolean(0), #false
            'user_id' => $this->faker->numberBetween(1,10),
        ];
    }
}
