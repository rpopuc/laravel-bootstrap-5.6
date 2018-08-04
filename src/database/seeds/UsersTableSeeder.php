<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => env('BOOTSTRAP_USER_NAME', 'Laravel'),
            'email' => env('BOOTSTRAP_USER_EMAIL', 'laravel@laravel.com'),
            'password' => \Hash::make(env('BOOTSTRAP_USER_PASSWORD', 'laravel')),
        ]);
    }
}
