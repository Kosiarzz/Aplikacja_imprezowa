<?php

namespace Database\Factories;

use App\Models\Statistic;
use Illuminate\Database\Eloquent\Factories\Factory;

class StatisticFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Statistic::class;

    private static $businessId = 1;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'views' => $this->faker->numberBetween(1,40),
            'likes' => $this->faker->numberBetween(1,20),
            'reservations' => $this->faker->numberBetween(1,20),
            'date' => $this->faker->dateTimeBetween('-5 days','now'),
            'business_id' => self::$businessId,
        ];
    }
}
