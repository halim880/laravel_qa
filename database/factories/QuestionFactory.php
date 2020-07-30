<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Question;
use Faker\Generator as Faker;

$factory->define(Question::class, function (Faker $faker) {
    return [
        'title'=> rtrim($faker->sentence(rand(5,10)), "."),
        'body'=> $faker->paragraphs(rand(3,5), true),
        'views'=> rand(0, 100),
        'votes'=> rand(0, 100),
        'answers'=> rand(0, 100),
    ];
});
