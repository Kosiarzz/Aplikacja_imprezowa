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
            'content' => $this->faker->sentence,
            'status' => $this->faker->boolean(50),
            'shown' => $this->faker->boolean(0),
            'content_type' => $this->faker->randomElement(['success','danger']),
            'notification_type' => $this->faker->randomElement(['App\Models\Business','App\Models\User']),
            'notification_id' => $this->faker->numberBetween(1,10),
        ];
    }
}
