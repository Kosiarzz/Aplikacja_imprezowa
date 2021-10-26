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

            ['name' => 'Nocleg',   'type' => 'dinfo'],
            ['name' => 'Parking', 'type' => 'dinfo'],
            ['name' => 'Taras',  'type' => 'dinfo'],
            ['name' => 'Ogród',  'type' => 'dinfo'],
            ['name' => 'Klimatyzacja',  'type' => 'dinfo'],

            ['name' => 'Dekoracje światłem',   'type' => 'atrakcje'],
            ['name' => 'Fotobudka', 'type' => 'atrakcje'],
            ['name' => 'Napis LOVE',  'type' => 'atrakcje'],
            ['name' => 'Słądki kącik',  'type' => 'atrakcje'],

            ['name' => 'Kategoria usera 1',  'type' => 'user'],

            ['name' => 'Fotograf',  'type' => 'mainCategory'],
            ['name' => 'DJ',  'type' => 'mainCategory'],
            ['name' => 'Barman',  'type' => 'mainCategory'],
        ];

        Category::insert($data);
    }
}