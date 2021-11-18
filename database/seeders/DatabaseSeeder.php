<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        \App\Models\City::factory(20)->create();
        \App\Models\Business::factory(10)->create();
        \App\Models\Address::factory(10)->create();
        \App\Models\Comment::factory(100)->create();      
        \App\Models\Notification::factory(40)->create();
        #\App\Models\Event::factory(1)->create();
        \App\Models\Social::factory(10)->create();
        \App\Models\Likeable::factory(150)->create();
        \App\Models\Photo::factory(200)->create();
        \App\Models\Service::factory(100)->create();
        #\App\Models\Reservation::factory(50)->create();
        \App\Models\QuestionAndAnswer::factory(100)->create();
        \App\Models\BusinessCategory::factory(50)->create();
        \App\Models\Contact::factory(20)->create();

        $this->call([
            PartyCategorySeeder::class,
            RoomCategorySeeder::class,
            RoomSelectCategorySeeder::class,
            ServicesCategorySeeder::class,
            MusicSelectCategorySeeder::class,
            MusicCategorySeeder::class,
            PhotoSelectCategorySeeder::class,
            PhotoCategorySeeder::class,
            DecorationCategorySeeder::class,
            DecorationSelectCategorySeeder::class,
            AttractionCategorySeeder::class,
            AttractionSelectCategorySeeder::class,
            MainCategorySeeder::class,
        ]);
    }
}
