<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(App\Event::class, function (Faker $faker) {

    
    
    return [
        'title' => $faker->text(50),
        'description' => $faker->text(500),
        'password' => Hash::make('password'),
        'lat' => $faker->randomFloat(null, 0, 90),
        'lng' => $faker->randomFloat(null, 0, 90),
        'cover' => '',
        'date' => $faker->dateTimeBetween('+2 months', '+2 years'),
        'comments_number' => 0,
        'views_number' => rand(0, 50000)
    ];
});
