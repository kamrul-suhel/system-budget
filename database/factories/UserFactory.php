<?php

use App\Customer;
use App\Setting;
use App\User;
use App\Seller;
use App\Product;
use App\Category;
use App\Transaction;
use Faker\Generator as Faker;

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
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'verified' => $verified = $faker->randomElement([User::VERIFIED_USER, User::UNVERIFIED_USER]),
        'verification_token' => $verified == User::VERIFIED_USER ? null : User::generateVerificationCode(),
        'admin' => $faker->randomElement([User::ADMIN_USER, User::REGULAR_USER])
    ];
});

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'mobile' => $faker->phoneNumber,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'active' => $faker->randomElement([1, 0])
    ];
});


$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1)
    ];
});

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1),
        'quantity' => $faker->numberBetween(1, 10),
        'sale_price' => $faker->randomNumber(2),
        'purchase_price' => $faker->randomNumber(2),
        'status' => $faker->randomElement([Product::UNAVAILABLE_PRODUCT, Product::ABAILABLE_PRODUCT]),
        'quantity_type' => $faker->randomElement([Product::PRODUCTTYPEITEM, Product::PRODUCTTYPEKG, Product::PRODUCTTYPLITTER]),
        'image' => $faker->randomElement(['1.jpg', '2.jpg', '3.jpg', '4.jpg']),
        'seller_id' => User::all()->random()->id,

    ];
});

$factory->define(Transaction::class, function (Faker $faker) {

    $seller = Seller::has('products')->get()->random();
    $customer = Customer::all()->random();


    return [
        'quantity' => $faker->numberBetween(1, 3),
        'customer_id' => $customer->id,
        'product_id' => $seller->products->random()->id,
        'payment_status' => $faker->randomElement([Transaction::TRANSACTION_STATUS_DUE, Transaction::TRANSICTION_STATUS_OK]),
        'payment_due'   => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 4000),
        'paied'         => $faker->randomFloat($nbMaxDecimals =2, $min = 0, $max = 2000),
        'created_at'    => $faker->dateTimeBetween($startDate = '-5 month', $endDate = 'now'),
        'updated_at'    => $faker->dateTimeBetween($startDate = '-5 month', $endDate = 'now')
    ];
});

$factory->define(Setting::class, function(Faker $faker){
    return [
        'company_name'      => $faker->company,
        'company_address'   => $faker->address,
        'company_phone'     => $faker->phoneNumber,
        'company_mobile'    => $faker->phoneNumber,
        'company_email'     => $faker->email,
        'company_fax'       => $faker->phoneNumber
    ];
});