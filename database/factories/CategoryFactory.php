<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Model\Category::class, function (Faker $faker) {
    $name = $faker->jobTitle;
    return [
        'name' => $name,
        'slug' => Str::slug($name)
    ];
});
