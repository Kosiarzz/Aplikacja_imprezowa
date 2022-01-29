<?php

namespace Database\Seeders\required;

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
            //Obsługiwane imprezy
            ['name' => 'Wesele'],
            ['name' => 'Urodziny'],
            ['name' => 'Komunia święta'],
            ['name' => 'Chrzciny'],

            //Kategorie usług
            ['name' => 'Sale'],
            ['name' => 'Fotograf'],
            ['name' => 'Muzyka'],
            ['name' => 'Dekoracje'],
            ['name' => 'Atrakcje'],

            ['name' => 'Wynajem'],
            ['name' => 'Barman'],
            ['name' => 'Uroda'],
            ['name' => 'Barista'],
            ['name' => 'Catering'],
            ['name' => 'Animatorzy'],
            ['name' => 'Artysta'], 
            ['name' => 'Cukiernia'],
            ['name' => 'Fryzjer'],
            ['name' => 'Garnitury'],
            ['name' => 'Biżuteria'],
            ['name' => 'Szkoła tańca'],

             //konkretne usług
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
            ['name' => 'Fotograf'],
            ['name' => 'Kamerzysta'],
            ['name' => 'Zespół muzyczny'],
            ['name' => 'DJ'],
            ['name' => 'Salon sukien'],
            ['name' => 'Auto do wynajęcia'],
            ['name' => 'Fotobudka'],
            ['name' => 'Wynajem busów'],
            ['name' => 'Artykuły'],
            ['name' => 'Cięzki dym'],
            ['name' => 'Balony'],
            ['name' => 'Artysta'],
            ['name' => 'Czekoladowa fontanna'],
            ['name' => 'Dekoracje światłem'],
            ['name' => 'Iluzjonista'],
            ['name' => 'Bukiety'],
            ['name' => 'Napis love'],
            ['name' => 'Oprawa muzyczna'],
            ['name' => 'Pokaz sztucznych ogni'],
            ['name' => 'Pokaz tańca'],
            ['name' => 'Pokazy laserowe'],
            ['name' => 'Prezenty'],
            ['name' => 'Słodki kącik'],
            ['name' => 'Tort'],
            ['name' => 'Teatr ognia'],
            ['name' => 'Zaproszenia'],

        ];

        Category::insert($data);
    }
}