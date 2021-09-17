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

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return[
            'title' => $this->faker->unique()->word,
            'description' => $this->faker->text(500),
            'short_description' => $this->faker->text(100),
            'priceFrom' => $this->faker->numberBetween(100,500),
            'priceTo' => $this->faker->numberBetween(500,1000),
            'unit' => 'jednostka',
            'range' => $this->faker->state,
            'user_id' => $this->faker->unique(true)->numberBetween(1,10),
            'city_id' => $this->faker->unique()->numberBetween(1,20),
            'address_id' => $this->faker->unique(true)->numberBetween(1,10),
            'social_id' => $this->faker->unique(true)->numberBetween(1,10),
        ];
    }
}
