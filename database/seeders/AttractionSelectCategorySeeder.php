<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Group;
use App\Models\GroupCategory;
use App\Models\Category;

class AttractionSelectCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Kategorie
        $dataCategories = [
            ['name' => 'Bańki mydlane'],
            ['name' => 'Animatorzy dla dzieci'],
            ['name' => 'Artysta'],
            ['name' => 'Chodzenie na szczudłach'],
            ['name' => 'Ciężki dym'],
            ['name' => 'Czekoladowa fontanna'],
            ['name' => 'Fotobudka'],
            ['name' => 'Iluzjonista'],
            ['name' => 'Napis LOVE'],
            ['name' => 'Pokaz barmański'],
            ['name' => 'Pokaz tańca'],
            ['name' => 'Pokazy laserowe'],
            ['name' => 'Teatr ognia'],
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
            'name' => 'attractionSelectCategory', 
            'type' => 'attractionSelectCategory',
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
            $groupCategory->group_id = $group->id;
            $groupCategory->category_id = $sCategory->id;
            $groupCategory->save();
        }
    }
}
