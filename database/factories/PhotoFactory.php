<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Photo;
use Faker\Generator as Faker;

$factory->define(Photo::class, function (Faker $faker) {
    return [
        'url' => "https://picsum.photos/id/".random_int(1,1000)."/1900/1260"
    ];
});
