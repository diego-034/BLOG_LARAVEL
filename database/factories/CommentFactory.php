<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'comment' => $faker->paragraph,
        'user_id' => factory(App\Models\User::class),
        'post_id' => factory(App\Models\Post::class)
    ];
});
