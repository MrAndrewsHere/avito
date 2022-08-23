<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Models\Ad;
use App\Services\Utils\DateGenerator;
use Faker\Generator as Faker;

$factory->define(Ad::class, function (Faker $faker) {
    $dateTime = DateGenerator::step()->current(); //sorting created_at
    return [
        'name' => $faker->realText(100),
        'description' => $faker->realText(1000),
        'price' => random_int( 50, 200000),
        'created_at' => $dateTime,
        'updated_at' => $dateTime,
    ];
});
