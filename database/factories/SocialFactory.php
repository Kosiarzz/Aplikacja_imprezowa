<?php

namespace Database\Factories;

use App\Models\Social;
use Illuminate\Database\Eloquent\Factories\Factory;

class SocialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Social::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'facebook' => 'facebook',
            'instagram' => 'instagram',
            'www' => 'www',
            'youtube' => 'youtube',
            'movie_youtube' => 'movie_youtube',
            'business_id' => $this->faker->unique(true)->numberBetween(1,10),
        ];
    }
}
