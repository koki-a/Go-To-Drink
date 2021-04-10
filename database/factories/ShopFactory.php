<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Shop;
use App\User;
use App\Genre;
use Faker\Generator as Faker;

$factory->define(Shop::class, function (Faker $faker) {
    return [
        'name'        =>  $faker->realText(15),
        'address'     =>  $faker->address,
        'url'         =>  $faker->url,
        'tell'        =>  $faker->phoneNumber,
        'comment'     =>  $faker->realText(60),
        'created_at'  =>  $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
        'updated_at'  =>  $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
        'user_id' => function() {
            return factory(User::class);
        },
        'genre_id' => function() {
            return factory(Genre::class);
        }
    ];
});
