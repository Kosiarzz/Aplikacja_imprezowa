<?php

namespace Database\Seeders\required;

use Illuminate\Database\Seeder;

use App\Models\Group;
use App\Models\GroupCategory;
use App\Models\Category;

class DecorationSelectCategorySeeder extends Seeder
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
            ['name' => 'Balony'],
            ['name' => 'Dekoracja samochodu'],
            ['name' => 'Etykiety na alkochol'],
            ['name' => 'Podziękowania'],
            ['name' => 'Upominki dla gości'],
            ['name' => 'Balony z nadrukiem'],
            ['name' => 'Dekoracja stołu'],
            ['name' => 'Etykiekty na ciasto'],
            ['name' => 'Kieliszki'],
            ['name' => 'Kotyliony'],
            ['name' => 'Ozdoby bibułowe'],
            ['name' => 'Ozdoby na krzesła'],
            ['name' => 'Serwetki'],
            ['name' => 'Świece'],
            ['name' => 'Napis LOVE'],
            ['name' => 'Dekoracja ściany'],
            ['name' => 'Dekoracja sali'],
            ['name' => 'Dekoracja kościołu'],
            ['name' => 'Pokrowce na krzesła'],
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
            'name' => 'decorationSelectCategory', 
            'type' => 'decorationSelectCategory',
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
