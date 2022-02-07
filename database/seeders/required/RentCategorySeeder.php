<?php

namespace Database\Seeders\required;

use Illuminate\Database\Seeder;

use App\Models\Group;
use App\Models\GroupCategory;
use App\Models\Category;

class RentCategorySeeder extends Seeder
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
            ['name' => 'Wynajem'],
            ['name' => 'Auto do wynajęcia'],
            ['name' => 'Bus do wynajęcia'],
            ['name' => 'Bryczka do ślubu'],
            ['name' => 'Fotobudka'],
            ['name' => 'Napis LOVE'],
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
            'name' => 'rentCategory', 
            'type' => 'rentCategory',
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
