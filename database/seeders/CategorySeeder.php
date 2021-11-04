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
            ['name' => 'Wesele'],
            ['name' => 'Urodziny'],
            ['name' => 'Komunie'],

            ['name' => 'Sala'],
            ['name' => 'Lokal'],
            ['name' => 'Hotel'],
            ['name' => 'Pałac'],
            ['name' => 'Dworek'],
            ['name' => 'Zamek'],
            ['name' => 'Gospoda'],
            ['name' => 'Namiot'],
            ['name' => 'Ogród'],
            ['name' => 'Dom'],

            ['name' => 'Nocleg'],
            ['name' => 'Parking'],
            ['name' => 'Taras'],
            ['name' => 'Ogród'],
            ['name' => 'Klimatyzacja'],
            ['name' => 'Dekoracje światłem'],
            ['name' => 'Fotobudka'],
            ['name' => 'Napis LOVE'],
            ['name' => 'Słądki kącik'],


            ['name' => 'Fotograf'],
            ['name' => 'Muzyka'],
            ['name' => 'Sale'],

            ['name' => 'DJ'],
            ['name' => 'Zespół muzyczny'],

            ['name' => '4K'],
            ['name' => 'Dron'],
            ['name' => 'Kamerzysta'],
            ['name' => 'Fotograf'],
            ['name' => 'Sesja plenerowa'],
            ['name' => 'Sesja narzeczeńska'],

            ['name' => 'gra na żywo'],
            ['name' => 'efekty świetlne'],
            ['name' => 'prowadzenie zabaw'],
            ['name' => 'wokalista'],
            ['name' => 'wokalistka'],
            ['name' => 'akordeon'],
            ['name' => 'saksofon'],
            ['name' => 'skrzypce'],

        ];

        Category::insert($data);
    }
}