<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Subject;
use Faker\Generator as Faker;

$factory->define(Subject::class, function (Faker $faker) {
    return [
        'name' => 'Название предмета №' . strval(rand(1, 5)),
        'value' => rand(1, 5)
    ];
});
