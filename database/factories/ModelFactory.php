<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
		'name'           => $faker->name,
		'email'          => $faker->email,
		'password'       => bcrypt(str_random(10)),
		'remember_token' => str_random(10),
    ];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) {
	$title = str_slug($faker->name, "_");

	return [
		'title'        => $faker->name,
		'category_id'  => rand(1,2),
		'price'        => $faker->randomfloat(2,100, 9999.99),
		'quantity'     => rand(10,35),
		'abstract'     => $faker->paragraph(1),
		'content'      => $faker->paragraph(5),
		'published_at' => $faker->dateTime('now'),
		'slug' 		   => $faker->title,
    ];
});