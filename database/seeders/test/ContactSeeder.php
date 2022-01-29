<?php

namespace Database\Seeders\test;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contacts = [
            [
                'name' => 'Patryk',
                'surname' => 'Firma',
                'phone' => '456234778',
                'contactable_type' => 'App\Models\Business',
                'contactable_id' => 1,
            ],
            [
                'name' => 'Ola',
                'surname' => 'Zwykła',
                'phone' => '236890245',
                'contactable_type' => 'App\Models\User',
                'contactable_id' => 2,
            ],
        ];
        
        foreach($contacts as $contact)
        {
            $newContact = new Contact;
            $newContact->name = $contact['name'];
            $newContact->surname = $contact['surname'];
            $newContact->phone = $contact['phone'];
            $newContact->contactable_type = $contact['contactable_type'];
            $newContact->contactable_id = $contact['contactable_id'];
            $newContact->save();
        }
    }
}
