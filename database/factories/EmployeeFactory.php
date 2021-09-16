<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employee;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'company_id' => rand(1, 15),
        'department_id' => rand(1, 4),
        'email' => $faker->email,
        'phone' => $faker->numerify('###-###-####'),
        'staff_id' =>  Str::random(4),
        'address' => $faker->address,

    ];
});
