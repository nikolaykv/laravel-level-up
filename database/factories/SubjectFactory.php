<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Subject;
use Faker\Generator as Faker;
use Faker\Factory;

$factory->define(Subject::class, function (Faker $faker) {

    $faker = Factory::create('ru_RU');

    return [
        'name' => 'Название предмета ' . $faker->text(7),
    ];
});
