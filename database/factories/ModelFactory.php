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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
    
});

$factory->define(App\Residence::class, function (Faker\Generator $faker) {
    
    return [
        'category' => array_rand(array(
                'rent' => 1,
                'shared_rent' => 2,
                'lease_takeover' => 3
            ), 1),
        'street_adress' => $faker->streetAddress,
        'city' => $faker->city,
        'zip_code' => $faker->postcode,
        'state' => $faker->state,
        'type' => array_rand(array(
                'house' => 1,
                'appartment' => 2,
                'office' => 3,
                'commercial_space' => 4
            ), 1),
        'price' => $faker->numberBetween(100, 10000),
        'area' => $faker->numberBetween(100, 10000),
        'construction_area' => $faker->numberBetween(100, 10000),
        'price_range' => array_rand(array(
                '$1,000 to 10,000' => 1,
                '$10,000 to $100,000' => 2,
                '$100,000 to $1,000,000' => 3,
                'over a $1,000,000' => 4
            ), 1), 
        'area_range' => array_rand(array(
                '50 sq. feet to 150 sq. feet' => 1,
                '150 sq. feet to 500 sq. feet'=> 2,
                '500 sq. feet to 1,000 sq. feet' => 3,
                '1,000 sq. feet to 10,000 sq. feet' => 4,
                'over 10,000 sq. feet' => 5
            ), 1),
        'construction_area_range' => array_rand(array(
                '50 sq. feet to 150 sq. feet' => 1,
                '150 sq. feet to 500 sq. feet' => 2,
                '500 sq. feet to 1,000 sq. feet' => 3,
                '1,000 sq. feet to 10,000 sq. feet' => 4,
                'over 10,000 sq. feet' => 5
            ),1),
        'is_used' => array_rand(array(
                false => 0,
                true => 1
            )),
        'number_of_rooms' => $faker->numberBetween(1,6),
        'is_direct' => array_rand(array(
                false => 0,
                true => 1
            )),
        'number_of_bathrooms' => $faker->numberBetween(1,6),
        'parking_spots' => $faker->numberBetween(1,6),
        'has_garden' => $faker->numberBetween(0,1),
        'has_pool' => array_rand(array(
                false => 0,
                true => 1
            )),
        'pet_friendly' => array_rand(array(
                false => 0,
                true => 1
            )), 
        'laundry'=> array_rand(array(
                false => 0,
                true => 1
            )), 
        'utilities_included'=> array_rand(array(
                false => 0,
                true => 1
            )),
        'furniture_included'=> array_rand(array(
                false => 0,
                true => 1
            )), 
        'wifi_included' => array_rand(array(
                false => 0,
                true => 1
            ))
    ];
    
});

$factory->define(App\Photo::class, function(Faker\Generator $faker){
   
    return [
       'path' => $faker->imageURL(198, 198)
    ];
    
});

$factory->define(App\Description::class, function(Faker\Generator $faker){
        
     return [
        'title' => $faker->sentence(6),
        'description' => $faker->text(180)
     ];
});
