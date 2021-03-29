<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Shop::class, function (Faker $faker) {

    //Usersテーブルの中からランダムに1つのレコードのidを取得
    $user_id = App\User::all()->random(1)[0]->id;
    //Genresテーブルの中からランダムに1つのレコードのidを取得
    $genre_id = App\Genre::all()->random(1)[0]->id;

    return [
        'user_id'     =>  $user_id,
        'genre_id'    =>  $genre_id,
        'name'        =>  $faker->realText(15),
        'address'     =>  $faker->address,
        'url'         =>  $faker->url,
        'tell'        =>  $faker->phoneNumber,
        'comment'     =>  $faker->realText(60),
        'created_at'  =>  $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
        'updated_at'  =>  $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
    ];
});
