<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Group;
use App\Models\GroupCategory;
use App\Models\Category;

class RoomCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Typy obiektów (kategorie)
        $dataCategories = [
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
        ];

        $savedCategory = [];
        foreach($dataCategories as $dCategory)
        {
            $category = Category::firstOrCreate([
                "name" => $dCategory['name'],
            ]);

            $savedCategory[] = $category;
        }

        //Grupa
        $dataGroup = [
            'name' => 'roomCategory', 
            'type' => 'roomCategory',
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
