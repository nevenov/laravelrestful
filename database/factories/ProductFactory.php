<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'details' => $faker->paragraph,
        'price' => $faker->numberBetween(100, 2000),
        'stock' => $faker->randomDigit,
        'discount' => $faker->numberBetween(2, 50),
        'user_id' => function () {
                        return App\User::all()->random();
                    }
    ];
});
