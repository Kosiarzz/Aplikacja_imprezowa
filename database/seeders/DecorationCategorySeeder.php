<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Group;
use App\Models\GroupCategory;
use App\Models\Category;

class DecorationCategorySeeder extends Seeder
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
            ['name' => 'Dekoracje'],
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
            'name' => 'decorationCategory', 
            'type' => 'decorationCategory',
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
