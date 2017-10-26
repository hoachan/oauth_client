<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\LoginFacebook::class, function (Faker $faker) {

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'user_id' => $faker->name,
        'facebook_id' => $faker->name,
        'name' => $faker->name,
        'name' => $faker->name,
//        'password' => $password ?: $password = bcrypt('secret'),
        
        'remember_token' => str_random(10),
    ];
});
