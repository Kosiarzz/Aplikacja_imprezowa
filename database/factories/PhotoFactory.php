<?php

namespace Database\Factories;

use App\Models\Photo;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhotoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Photo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'photoable_type' => $this->faker->randomElement(['App\Models\Business','App\Models\User','App\Models\Service']),
            'photoable_id' => $this->faker->numberBetween(1,40),
            'path' => $this->faker->imageUrl(800,400,'city'),
        ];
    }
}
