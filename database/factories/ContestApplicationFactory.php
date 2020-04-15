<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Classes\ContestApplication;
use Faker\Generator as Faker;

$factory->define(ContestApplication::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'description' => $faker->text,
        'logo' => $faker->imageUrl($width = 640, $height = 480),
        'images' => [$faker->imageUrl($width = 640, $height = 480), $faker->imageUrl($width = 640, $height = 480)],
        'link' => $faker->url,
    ];
});
