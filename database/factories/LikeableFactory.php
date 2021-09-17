<?php

namespace Database\Factories;

use App\Models\Likeable;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeableFactory extends Factory
{
     /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Likeable::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'likeable_type' => $this->faker->randomElement(['App\Models\Business','App\Models\User','App\Models\Comment']),
            'likeable_id' => $this->faker->numberBetween(1,10),
            'user_id' => $this->faker->numberBetween(1,10),
        ];
    }
}
