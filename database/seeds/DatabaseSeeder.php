<?php

use App\Models\Ad;
use App\Models\Photo;
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
        Ad::factory(1000)->create()
            ->random(500)
            ->each(function ($ad) {
                $ad->photo()->saveMany(Photo::factory(random_int(1, 3))->make());
            });
    }
}
