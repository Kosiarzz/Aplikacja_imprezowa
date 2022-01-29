<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(30),
            'description' => $this->faker->text(500),
            'people_from' => $this->faker->numberBetween(1,10),
            'people_to' => $this->faker->numberBetween(10,100),
            'price_from' => $this->faker->numberBetween(100,1000),
            'price_to' => $this->faker->numberBetween(1000,5000),
            'unit' => $this->faker->randomElement(['za imprezę','za godzinę', 'za dobę']),
            'size' => $this->faker->numberBetween(10,200),
            'business_id' => $this->faker->numberBetween(1,10),
        ];
    }
}
