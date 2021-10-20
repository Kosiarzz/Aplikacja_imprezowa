<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Wesele',   'type' => 'party'],
            ['name' => 'Urodziny', 'type' => 'party'],
            ['name' => 'Komunie',  'type' => 'party'],

            ['name' => 'Sala',   'type' => 'lokal'],
            ['name' => 'Lokal', 'type' => 'lokal'],
            ['name' => 'Hotel',  'type' => 'lokal'],
            ['name' => 'Pałac',   'type' => 'lokal'],
            ['name' => 'Dworek', 'type' => 'lokal'],
            ['name' => 'Zamek',  'type' => 'lokal'],
            ['name' => 'Gospoda',   'type' => 'lokal'],
            ['name' => 'Namiot', 'type' => 'lokal'],
            ['name' => 'Ogród',  'type' => 'lokal'],
            ['name' => 'Dom',   'type' => 'lokal'],
        ];

        Category::insert($data);
    }
}

<option value="sala">Sala</option>
<option value="lokal">Lokal</option>
<option value="hotel">Hotel</option>
<option value="palac">Pałac</option>
<option value="dworek">Dworek</option>
<option value="zamek">Zamek</option>
<option value="gospoda">Gospoda</option>
<option value="namiot">Namiot</option>
<option value="ogrod">Ogród</option>
<option value="dom">Dom</option>