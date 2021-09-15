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
        \App\Models\Comment::factory(30)->create();      
        \App\Models\Notification::factory(10)->create();
        \App\Models\Social::factory(10)->create();
        \App\Models\Likeable::factory(10)->create();
        \App\Models\Photo::factory(100)->create();
        \App\Models\Room::factory(100)->create();
        \App\Models\Reservation::factory(100)->create();
        \App\Models\Role::factory(4)->create();
    }
}
