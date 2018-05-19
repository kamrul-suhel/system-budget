<?php

use App\Customer;
use App\User;
use App\Product;
use App\Category;
use App\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        User::truncate();
        Customer::truncate();
        Category::truncate();
        Product::truncate();
        Transaction::truncate();
        DB::table('category_product')->truncate();

        User::flushEventListeners();
        Product::flushEventListeners();
        Category::flushEventListeners();
        Transaction::flushEventListeners();
        Customer::flushEventListeners();

        $usersQuantity = 30;
        $customerQuantity = 10;
        $categoriesQuantity = 200;
        $productsQuantity = 200;
        $transactionQuantity = 200;

        $categoryRoot = Category::create([
            'name' => 'category 1',
            'description' => 'Category description',
            'parent_id'   => null,
            'lft'          => 1,
            'rgt'           => 12
        ]);


        $categoryRoot->children()->create([
            'name' => 'category 2',
            'description' => 'Category description',
            'parent_id'   => 1,
            'lft'          => 2,
            'rgt'           => 3,
            'depth'         => 1
        ]);

        $categoryRoot->children()->create([
            'name' => 'category 3',
            'description' => 'Category description',
            'parent_id'   => 1,
            'lft'          => 4,
            'rgt'           => 5,
            'depth'         => 1
        ]);

        $categoryRoot->children()->create([
            'name' => 'category 4',
            'description' => 'Category description',
            'parent_id'   => 1,
            'lft'          => 6,
            'rgt'           => 7,
            'depth'         => 1
        ]);

        $categoryRoot->children()->create([
            'name' => 'category 5',
            'description' => 'Category description',
            'parent_id'   => 1,
            'lft'          => 8,
            'rgt'           => 9,
            'depth'         => 1
        ]);

        $categoryRoot->children()->create([
            'name' => 'category 6',
            'description' => 'Category description',
            'name' => 'category 2',
            'description' => 'Category description',
            'parent_id'   => 1,
            'lft'          => 10,
            'rgt'           => 11,
            'depth'         => 1
        ]);

//        factory(Category::class, $categoriesQuantity)->create()->each(function($category){
//            $root = Category::root();
//            if($category->id == 1){
//                $category->makeRoot();
//                return;
//            }
//            $category->makeChildOf($root);
//        });



        factory(User::class, $usersQuantity)->create();
        factory(Customer::class, $customerQuantity)->create();

        factory(Product::class, $productsQuantity)->create()->each(
        	function($product){
        		$categories = Category::all()->random(mt_rand(1, 5))->pluck('id');

        		$product->categories()->attach($categories);
        	}
        );

        factory(Transaction::class, $transactionQuantity)->create();
    }
}
