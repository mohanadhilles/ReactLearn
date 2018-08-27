<?php

$factory->define(App\PermissionsManagment::class, function (Faker\Generator $faker) {
    return [
        "out" => $faker->date("d/m/Y H:i:s", $max = 'now'),
        "back" => $faker->date("d/m/Y H:i:s", $max = 'now'),
        "reason" => $faker->name,
        "employee_id" => factory('App\User')->create(),
    ];
});
