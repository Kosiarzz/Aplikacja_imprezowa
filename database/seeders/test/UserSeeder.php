<?php

namespace Database\Seeders\test;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Photo;
use App\Models\Contact;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'role' => 'business',
                'email' => 'test.business@business.com',
                'email_verified_at' => now(),
                'password' => bcrypt('test1234'),
                'remember_token' => Str::random(10),
                'photo' => 'photos/test.png',
            ],
            [
                'role' => 'user',
                'email' => 'test.user@user.com',
                'email_verified_at' => now(),
                'password' => bcrypt('test1234'),
                'remember_token' => Str::random(10),
                'photo' => 'photos/test.png',
            ],
        ];
        

        foreach($users as $user)
        {
            $newUser = new User;
            $newUser->role = $user['role'];
            $newUser->email = $user['email'];
            $newUser->email_verified_at = $user['email_verified_at'];
            $newUser->password = $user['password'];
            $newUser->remember_token = $user['remember_token'];
            $newUser->save();

            $newPhoto = new Photo;
            $newPhoto->path = $user['photo'];
            $newPhoto->photoable_type = "App\Models\User";
            $newPhoto->photoable_id = $newUser->id;
            $newPhoto->save();
        }
    }
}
