<?php

namespace Database\Seeders\required;

use Illuminate\Database\Seeder;

use App\Models\Group;
use App\Models\GroupCategory;
use App\Models\Category;

class AttractionCategorySeeder extends Seeder
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
            ['name' => 'Atrakcje'],
            ['name' => 'Pokaz barmański'],
            ['name' => 'Pokaz sztucznych ogni'],
            ['name' => 'Pokaz tańca'],
            ['name' => 'Pokaz laserowy'],
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
            'name' => 'attractionCategory', 
            'type' => 'attractionCategory',
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
