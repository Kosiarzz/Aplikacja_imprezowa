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

    private static $businessId = 1;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'facebook' => 'https://www.facebook.com/',
            'instagram' => 'https://www.instagram.com/',
            'www' => 'https://www.google.com/',
            'youtube' => 'https://www.youtube.com/',
            'movie_youtube' => 'https://www.youtube.com/embed/5wmgF0WZfcY',
            'business_id' => self::$businessId++,
        ];
    }
}
