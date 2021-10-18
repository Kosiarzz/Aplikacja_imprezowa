<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Wesele',   'type' => 'party'],
            ['name' => 'Urodziny', 'type' => 'party'],
            ['name' => 'Komunie',  'type' => 'party']
        ];

        Category::insert($data);
    }
}
