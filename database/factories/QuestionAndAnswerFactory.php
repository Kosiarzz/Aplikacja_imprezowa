<?php

namespace Database\Factories;

use App\Models\QuestionAndAnswer;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionAndAnswerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = QuestionAndAnswer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'question' => $this->faker->text(50),
            'answer' => $this->faker->text(80),
            'business_id' => $this->faker->numberBetween(1, 30),
        ];
    }
}
