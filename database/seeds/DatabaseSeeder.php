php artisan make<?php

use Illuminate\Database\Seeder;

use App\User;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Validator;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::insert([
            'username' => 'christonit',
            'email' => 'christopher.sant@outlook.com',
            'password' => Hash::make('123456ch'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_At'=> date("Y-m-d H:i:s"),

        ]);

        // $this->call(UsersTableSeeder::class);
    }
}
