<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Student;
use Faker\Generator as Faker;
use Faker\Factory;

$factory->define(Student::class, function (Faker $faker)  {

    $faker = Factory::create('ru_RU');

    return [
        'group_id' => $faker->numberBetween(1, 5),
        'subject_id' => $faker->numberBetween(1, 5),
        'academic_grade' => rand(1, 5)
    ];
});
