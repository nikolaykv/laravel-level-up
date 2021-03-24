<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Student;
use Faker\Generator as Faker;
use Faker\Factory;
use Illuminate\Support\Str;

$factory->define(Student::class, function (Faker $faker)  {

    $faker = Factory::create('ru_RU');

    return [
        'name' => $faker->firstName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'remember_token' => Str::random(10),
        'surname' => $faker->lastName,
        'group_id' => $faker->numberBetween(1, 5),
    ];
});
