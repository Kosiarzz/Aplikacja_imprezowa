<?php

namespace Database\Factories;

use App\Models\Business;
use App\Models\Group;
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
            'title' => $this->faker->text(80),
            'description' => $this->faker->text(1400),
            'short_description' => $this->faker->text(175),
            'rating' => $this->faker->numberBetween(1, 5),
            'main_category_id' => $this->faker->numberBetween(1, 50),
            'user_id' => self::$userId,
            'city_id' => $this->faker->unique()->numberBetween(1,40),
        ];
    }
}
