<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users = [
            // ['firstname' =>'John', 'lastname' => 'Bravo', 'email' => 'johnb@gmail.com'],
            ['firstname' =>'Jane', 'lastname' => 'Smith', 'email' => 'janes@gmail.com'],
            // ['firstname' =>'Kaye', 'lastname' => 'Kim', 'email' => 'kayk@gmail.com'],
        ];

        foreach($users as $userData){
            $firstname = trim($userData['firstname']);
            $lastname = trim($userData['lastname']);

            //gnerate usrename
            $username = strtoupper(substr($firstname, 0, 1)) . strtolower($lastname);

            User::create([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $userData['email'],
                'username' => $username,
                'password' => Hash::make('password'),
                'org_type' => 1,
                'usertype' => 2,
                'user_img' => 'default.img',
            ]);
        }
    }
}
