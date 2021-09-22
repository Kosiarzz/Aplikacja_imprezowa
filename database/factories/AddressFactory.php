<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'business_name' => $this->faker->word,
            'phone' => $this->faker->phoneNumber,
            'post_code' => $this->faker->postcode,
            'street' => $this->faker->streetAddress,
            'details_address' => $this->faker->streetName,
            'business_id' => $this->faker->unique(true)->numberBetween(1,10),
        ];
    }
}
