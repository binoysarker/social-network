<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    static $password;
    $rndNum = rand(0,1);
    return [
        'name' => $faker->name,
        'slug' => str_slug($faker->name),
        'gender' => rand(0,1),
        'avater' => $rndNum == 0 ?'public/defaults/avaters/female.png':'public/defaults/avaters/male.png',
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
