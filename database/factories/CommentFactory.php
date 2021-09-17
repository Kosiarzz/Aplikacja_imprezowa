<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->faker->text(200),
            'commentable_type' => 'App\Models\Business',
            'commentable_id' => $this->faker->numberBetween(1,30),
            'rating' => $this->faker->numberBetween(1,5),
            'user_id' => $this->faker->numberBetween(1,10),
        ];
    }
}
