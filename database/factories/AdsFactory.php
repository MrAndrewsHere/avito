<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Models\Ads;
use App\Services\Utils\DateGenerator;
use Faker\Generator as Faker;

$factory->define(Ads::class, function (Faker $faker) {
    $dateTime = DateGenerator::step()->current(); //Для проверки сортировки по created_at
    return [
        'name' => $faker->realText(100),
        'description' => $faker->realText(1000),
        'price' => $faker->randomFloat(2, 50, 200000),
        'created_at' => $dateTime,
        'updated_at' => $dateTime,
    ];
});
