<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\api_clients;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$Gv0u1PN9Kx/4gu29o5SqS.jQsA1v394CWvGfdbJl3M6CnxS4yloVC', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(App\api_clients::class, function (Faker $faker) {
    return [
      'active' => 1,
      'client_email' => $faker->unique()->safeEmail,
      'short_description' => $faker->text(),
      'full_description' => $faker->text(),
      'logo_url' => '/img/car.jpg',
      'url' => 'www.monsite.fr',
      'dpo' => $faker->name(),
      'technical_contact' => $faker->name(),
      'commercial_contact' => $faker->name(),
      'client_name' => $faker->name(),
    ];
});
