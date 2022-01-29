<?php

namespace Database\Seeders;
use App\Models\{City, Business, Address, Comment, Notification, Event, Social, Photo, Service, QuestionAndAnswer, OpeningHours, Statistic, Contact};

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
        $this->call([
            //require data
            required\CategorySeeder::class,
            required\AttractionCategorySeeder::class,
            required\AttractionSelectCategorySeeder::class,
            required\CateringCategorySeeder::class,
            required\CateringSelectCategorySeeder::class,
            required\DecorationCategorySeeder::class,
            required\DecorationSelectCategorySeeder::class,
            required\MainCategorySeeder::class,
            required\MusicCategorySeeder::class,
            required\MusicSelectCategorySeeder::class,
            required\PartyCategorySeeder::class,
            required\PhotoCategorySeeder::class,
            required\PhotoSelectCategorySeeder::class,
            required\RentCategorySeeder::class,
            required\RoomCategorySeeder::class,
            required\RoomSelectCategorySeeder::class,
            required\ServiceCategorySeeder::class,
            required\ServicesCategorySeeder::class,
            required\ServiceSelectCategorySeeder::class,
            required\ShopCategorySeeder::class,
            required\ShopSelectCategorySeeder::class,

            //test data
            test\ContactSeeder::class,
            test\UserSeeder::class,
            
        ]);

        //test data
        City::factory(40)->create();
        Business::factory(30)->create();
        Address::factory(30)->create();
        OpeningHours::factory(30)->create();
        Comment::factory(100)->create();      
        Notification::factory(100)->create();
        Event::factory(10)->create();
        Social::factory(30)->create();
        Photo::factory(200)->create();
        Service::factory(100)->create();
        QuestionAndAnswer::factory(100)->create();
        Statistic::factory(100)->create();
        Contact::factory(30)->create();
    }
}
