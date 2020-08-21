<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'post_title' => $faker->title,
        'post_body' => $faker->paragraph,
        'user_id' => factory(App\Models\User::class)
    ];
});
