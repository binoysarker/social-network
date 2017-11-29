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
        'gender' => $rndNum,
        'avatar' => $rndNum == 0 ?'public/defaults/avatars/female.png':'public/defaults/avatars/male.png',
        'cover_photo' => 'public/defaults/avatars/cover.jpg',
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Profile::class, function ($faker) {
    return [
        'location' => null,
        'about' => null,
        'address' => null,
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});

$factory->define(\App\Models\WorkProfile::class, function ($faker) {
    return [
        'company' => $faker->company,
        'position' => $faker->jobTitle,
        'city' => $faker->city,
        'description' => $faker->paragraph(3),
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});

$factory->define(\App\Models\EducationProfile::class, function ($faker) {
    return [
        'school' => $faker->company,
        'time_period' => $faker->date('Y-m-d','now'),
        'description' => $faker->paragraph(4),
        'graduation' => $faker->boolean(50),
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});