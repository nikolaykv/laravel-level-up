<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Student;
use Faker\Generator as Faker;
use Faker\Factory;


$factory->define(Student::class, function (Faker $faker) {

    $faker = Factory::create('ru_RU');

    return [
        'name' => $faker->firstName,
        'surname' => $faker->lastName,
        'group_id' => $faker->numberBetween(1, 5),
        'grade_id' => $faker->numberBetween(1, 5)
    ];
});
