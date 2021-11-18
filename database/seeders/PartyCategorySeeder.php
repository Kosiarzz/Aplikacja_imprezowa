<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Group;
use App\Models\GroupCategory;
use App\Models\Category;

class PartyCategorySeeder extends Seeder
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
            ['name' => 'Wesele'],
            ['name' => 'Urodziny'],
            ['name' => 'Komunie'],
        ];

        $savedCategory = [];
        foreach($dataCategories as $dCategory)
        {
            $category = new Category;
            $category->name = $dCategory['name'];
            $category->save();

            $savedCategory[] = $category;
        }


        //Grupa obsługiwanych imprez
        $dataGroup = [
            'name' => 'partyCategory', 
            'type' => 'partyCategory',
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
