<?php

namespace Database\Factories;

use App\Models\Business;
use Illuminate\Database\Eloquent\Factories\Factory;

class BusinessFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Business::class;

    private static $userId = 1;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return[
            'name' => $this->faker->company,
            'title' => $this->faker->jobTitle,
            'description' => $this->faker->text(500),
            'short_description' => $this->faker->text(100),
            'main_category_id' => $this->faker->numberBetween(1,10),
            'user_id' => self::$userId++,
            'city_id' => $this->faker->unique()->numberBetween(1,20),
        ];
    }
}
