<?php

$factory->define(App\Leave::class, function (Faker\Generator $faker) {
    return [
        "day" => $faker->date("d/m/Y", $max = 'now'),
        "reason" => $faker->name,
        "status" => collect(["accept","forbidden",])->random(),
        "employee_id" => factory('App\User')->create(),
    ];
});
