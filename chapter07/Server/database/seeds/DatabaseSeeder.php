<?php

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
        $this->call(BikesTableSeeder::class);
        $this->call(BikesGaragesTableSeeder::class);
        $this->call(BuildersTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
        $this->call(GaragesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
