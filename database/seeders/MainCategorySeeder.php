<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Group;
use App\Models\GroupCategory;
use App\Models\Category;

class MainCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Kategorie główne
        $dataCategories = [
            ['name' => 'Sala'],
            ['name' => 'Fotograf'],
            ['name' => 'Kamerzysta'],
            ['name' => 'DJ'],
            ['name' => 'Salon sukien'],
            ['name' => 'Zespół muzyczny'],
            ['name' => 'Auto do wynajęcia'],
            ['name' => 'Dekoracje'],
            ['name' => 'Fotobudka'],
            ['name' => 'Barman'],
            ['name' => 'Uroda'],
            ['name' => 'Makijaż'],
            ['name' => 'Fryzjer'],
            ['name' => 'Bus do wynajęcia'],
            ['name' => 'Animator dla dzieci'],
            ['name' => 'Zaproszenia'],
            ['name' => 'Artysta'],
            ['name' => 'Barista'],
            ['name' => 'Bryczka do ślubu'],
            ['name' => 'Catering'],
            ['name' => 'Ciężki dym'],
            ['name' => 'Fontanna czekoladowa'],
            ['name' => 'Bańki mydlane'],
            ['name' => 'Napis LOVE'],
            ['name' => 'Dekoracje światłem'],
            ['name' => 'Garnitury'],
            ['name' => 'Iluzjonista'],
            ['name' => 'Bukiety'],
            ['name' => 'Obrączki'],
            ['name' => 'Pokaz barmański'],
            ['name' => 'Pokaz sztucznych ogni'],
            ['name' => 'Pokaz tańca'],
            ['name' => 'Pokazy laserowe'],
            ['name' => 'Prezenty'],
            ['name' => 'Słodki stół'],
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
            'name' => 'mainCategory', 
            'type' => 'mainCategory',
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
