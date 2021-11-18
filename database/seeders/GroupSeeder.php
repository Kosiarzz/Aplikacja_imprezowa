<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\GroupCategory;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'party', 'type' => 'party'],

            ['name' => 'mainCategory', 'type' => 'mainCategory'],

            ['name' => 'lokal', 'type' => 'lokal'],
            ['name' => 'category_lokal', 'type' => 'category_lokal'],

            ['name' => 'music', 'type' => 'music'],
            ['name' => 'category_photo', 'type' => 'category_photo'],
            
            ['name' => 'photo', 'type' => 'photo'],
            ['name' => 'category_music', 'type' => 'category_music'],
        ];

        Group::insert($data);

        $data = [
            //party type
            ['icon_name' => '', 'group_id' => 1 , 'category_id' => 1],
            ['icon_name' => '', 'group_id' => 1 , 'category_id' => 2],
            ['icon_name' => '', 'group_id' => 1 , 'category_id' => 3],

            //main category
            ['icon_name' => '', 'group_id' => 2 , 'category_id' => 23],
            ['icon_name' => '', 'group_id' => 2 , 'category_id' => 24],
            ['icon_name' => '', 'group_id' => 2 , 'category_id' => 25],

            //main category loca3
            ['icon_name' => '', 'group_id' => 3 , 'category_id' => 4],
            ['icon_name' => '', 'group_id' => 3 , 'category_id' => 5],
            ['icon_name' => '', 'group_id' => 3 , 'category_id' => 6],
            ['icon_name' => '', 'group_id' => 3 , 'category_id' => 7],
            ['icon_name' => '', 'group_id' => 3 , 'category_id' => 8],
            ['icon_name' => '', 'group_id' => 3 , 'category_id' => 9],
            ['icon_name' => '', 'group_id' => 3 , 'category_id' => 10],
            ['icon_name' => '', 'group_id' => 3 , 'category_id' => 11],
            ['icon_name' => '', 'group_id' => 3 , 'category_id' => 12],
            ['icon_name' => '', 'group_id' => 3 , 'category_id' => 13],

            //additional category local
            ['icon_name' => '', 'group_id' => 4 , 'category_id' => 14],
            ['icon_name' => '', 'group_id' => 4 , 'category_id' => 15],
            ['icon_name' => '', 'group_id' => 4 , 'category_id' => 16],
            ['icon_name' => '', 'group_id' => 4 , 'category_id' => 17],
            ['icon_name' => '', 'group_id' => 4 , 'category_id' => 18],
            ['icon_name' => '', 'group_id' => 4 , 'category_id' => 19],
            ['icon_name' => '', 'group_id' => 4 , 'category_id' => 20],
            ['icon_name' => '', 'group_id' => 4 , 'category_id' => 21],
            ['icon_name' => '', 'group_id' => 4 , 'category_id' => 22],
            

            //music main
            ['icon_name' => '', 'group_id' => 5 , 'category_id' => 26],
            ['icon_name' => '', 'group_id' => 5 , 'category_id' => 27],

            //photo additional
            ['icon_name' => '', 'group_id' => 6 , 'category_id' => 28],
            ['icon_name' => '', 'group_id' => 6 , 'category_id' => 29],
            ['icon_name' => '', 'group_id' => 6 , 'category_id' => 30],
            ['icon_name' => '', 'group_id' => 6 , 'category_id' => 31],
            ['icon_name' => '', 'group_id' => 6 , 'category_id' => 32],
            ['icon_name' => '', 'group_id' => 6 , 'category_id' => 33],
            //photo main
            ['icon_name' => '', 'group_id' => 7 , 'category_id' => 23],

            //music additional
            ['icon_name' => '', 'group_id' => 8 , 'category_id' => 34],
            ['icon_name' => '', 'group_id' => 8 , 'category_id' => 35],
            ['icon_name' => '', 'group_id' => 8 , 'category_id' => 36],
            ['icon_name' => '', 'group_id' => 8 , 'category_id' => 37],
            ['icon_name' => '', 'group_id' => 8 , 'category_id' => 38],
            ['icon_name' => '', 'group_id' => 8 , 'category_id' => 39],
            ['icon_name' => '', 'group_id' => 8 , 'category_id' => 40],
            ['icon_name' => '', 'group_id' => 8 , 'category_id' => 41],
            
        ];

        GroupCategory::insert($data);
    }
}
