<?php

namespace Database\Factories;

use App\Models\OpeningHours;
use Illuminate\Database\Eloquent\Factories\Factory;

class OpeningHoursFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OpeningHours::class;

    private static $businessId = 1;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'monday' => '8:00 - 16:00',
            'tuesday' => '8:00 - 16:00',
            'wednesday' => '8:00 - 16:00',
            'thursday' => '8:00 - 16:00',
            'friday' => '8:00 - 16:00',
            'saturday' => '10:00 - 14:00',
            'sunday' => 'Zamknięte',
            'business_id' => self::$businessId++,
        ];
    }
}
