<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        
        DB::table('users')->insert([
            'name' => 'Johnny Cash',
            'email' => 'johnny@cash.com',
            'password' => Hash::make('123456')
        ]);;

        DB::table('users')->insert([
            'name' => 'Frank Sinatra',
            'email' => 'frank@sinatra.com',
            'password' => Hash::make('123456')
        ]);
    }
}
