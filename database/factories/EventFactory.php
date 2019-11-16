<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Event::class, function (Faker $faker) {

    $covers = [
        '/images/placeholder (1).jpg',
        '/images/placeholder (2).jpg',
        '/images/placeholder (3).jpg',
        '/images/placeholder (4).jpg',
        '/images/placeholder (5).jpg',
        '/images/placeholder (6).jpg',
        '/images/placeholder (7).jpg',
    ];
    
    return [
        'title' => $faker->text(50),
        'description' => $faker->text(500),
        'lat' => $faker->randomFloat(null, 0, 90),
        'lng' => $faker->randomFloat(null, 0, 90),
        'cover' => (rand() % 2 == 0 ) ? null : $covers[rand() % count($covers)],
        'date' => $faker->dateTimeBetween('+2 months', '+2 years'),
        'comments_number' => rand(20, 20000),
        'views_number' => rand(0, 50000)
    ];
});
