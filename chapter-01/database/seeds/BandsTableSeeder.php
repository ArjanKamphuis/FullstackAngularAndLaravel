<?php

use App\Band;
use Illuminate\Database\Seeder;

class BandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Band::class, 5)->create()->each(function($p) {
            $p->save();
        });
    }
}
