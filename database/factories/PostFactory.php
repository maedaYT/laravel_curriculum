<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {

    return [
        'user_id' => User::inRandomOrder()->first()->id,
        'title' => $faker->streetAddress,
        'check_in_date' => $faker->date('Y_m_d'),
        'check_out_date' => $faker->date('Y_m_d'),
        'guest_count' => $faker->numberBetween('1, 15'),
        'price' => $faker->randomNumber('5,true'),
        'comment' => $faker->realText,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
