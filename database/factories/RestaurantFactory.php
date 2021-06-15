<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Restaurant;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Restaurant::class, function (Faker $faker) {
    $name = $faker->company;
    return [
        'user_id' => factory(User::class)->create()->id,
        'name' => $name,
        'email' => $faker->email,
        'phone_number' => $faker->phoneNumber,
        'vat_number' => $faker->regexify('[A-Za-z0-9]{11}'),
        'address' => $faker->address,
        'description' => $faker->sentence(5),
        'slug' => Str::slug($name),
    ];
});
