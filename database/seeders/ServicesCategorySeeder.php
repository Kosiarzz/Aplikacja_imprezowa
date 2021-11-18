<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Group;
use App\Models\GroupCategory;
use App\Models\Category;

class ServicesCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Obsługiwane imprezy (kategorie)
        $dataCategories = [
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
              ['name' => 'Fotograf i kamerzysta'],
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

        $savedCategory = [];
        foreach($dataCategories as $dCategory)
        {
            $category = Category::firstOrCreate([
                "name" => $dCategory['name'],
            ]);

            $savedCategory[] = $category;
        }


        //Grupa obsługiwanych imprez
        $dataGroup = [
            'name' => 'serviceCategory', 
            'type' => 'serviceCategory',
        ];

        $group = new Group;
        $group->name = $dataGroup['name'];
        $group->type = $dataGroup['type'];
        $group->save();

        //Przydzielenie kategorii do grupy
        foreach($savedCategory as $sCategory)
        {
            $groupCategory = new GroupCategory;
            $groupCategory->icon_name = '';
            $groupCategory->type = 'default';
            $groupCategory->group_id = $group->id;
            $groupCategory->category_id = $sCategory->id;
            $groupCategory->save();
        }
    }
}
