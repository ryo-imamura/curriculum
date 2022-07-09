<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => '今村',
            'email' => 'ryo@mail.com',
            'password' => bcrypt('imamuraryo'),
        ]);

        User::create([
            'name' => 'ryo',
            'email' => 'imamura@mail.com',
            'password' => bcrypt('imamuraryo'),
        ]);

        User::create([
            'name' => 'りょう',
            'email' => 'rimamura@mail.com',
            'password' => bcrypt('imamuraryo'),
        ]);
    }
}
