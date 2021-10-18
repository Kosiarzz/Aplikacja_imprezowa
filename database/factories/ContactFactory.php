<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    private static $contactId = 1;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        if(self::$contactId > 10)
        {
            $businessTypeId = self::$contactId - 10;
            self::$contactId++;

            return [
                'name' => $this->faker->firstName,
                'surname' => $this->faker->lastName,
                'phone' => $this->faker->phoneNumber,
                'contactable_type' => 'App\Models\Business',
                'contactable_id' => $businessTypeId,
            ];
        }

        return [
            'name' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
            'phone' => $this->faker->phoneNumber,
            'contactable_type' => 'App\Models\User',
            'contactable_id' => self::$contactId++,
        ];
    }
}
