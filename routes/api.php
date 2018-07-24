<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
*  Buyer route
*/

Route::resource('buyers','Buyer\BuyerController',['only' => ['index', 'show']]);
Route::resource('buyers.transactions','Buyer\BuyerTransactionController',['only' => ['index']]);
Route::resource('buyers.sellers','Buyer\BuyerSellerController',['only' => ['index']]);
Route::resource('buyers.categories','Buyer\BuyerCategoryController',['only' => ['index']]);
Route::resource('buyers.products','Buyer\BuyerProductController',['only' => ['index']]);


/*
*  Category route
*/

Route::resource('categories','Category\CategoryController',['except' => ['create', 'edit']]);
Route::resource('categories.products','Category\CategoryProductController',['only' => ['index']]);
Route::resource('categories.sellers','Category\CategorySellerController',['only' => ['index']]);
Route::resource('categories.transactions','Category\CategoryTransactionController',['only' => ['index']]);
Route::resource('categories.buyers','Category\CategoryBuyerController',['only' => ['index']]);

/*
*  Product route
*/

Route::resource('products','Product\ProductController',['only' => ['index', 'show','destroy', 'store','update']]);
Route::resource('products.transactions','Product\ProductTransactionController',['only' => ['index']]);
Route::resource('products.buyers','Product\ProductBuyerController',['only' => ['index']]);
Route::resource('products.categories','Product\ProductCategoryController',['except' => ['edit','show','create','store']]);
Route::resource('customers.transactions','Product\ProductBuyerTransactionController',['only' => ['store']]);


/*
*  Transition route
*/

Route::resource('transactions','Transaction\TransactionController',['only' => ['index', 'show']]);
Route::resource('transactions.categories','Transaction\TransactionCategoryController',['only' => ['index']]);
Route::resource('transactions.sellers','Transaction\TransactionSellerController',['only' => ['index']]);
Route::get('transactions/{id}/delete','Transaction\TransactionController@destroy');


/*
*  Seller route
*/

Route::resource('sellers','Seller\SellerController',['only' => ['index', 'show']]);
Route::resource('sellers.transactions','Seller\SellerTransactionController',['only' => ['index']]);
Route::resource('sellers.categories','Seller\SellerCategoryController',['only' => ['index']]);
Route::resource('sellers.buyers','Seller\SellerBuyerController',['only' => ['index']]);
Route::resource('sellers.products','Seller\SellerProductController',['except' => ['show','edit','create']]);


/*
*  Expense route
*/
Route::resource('expense', 'Expense\ExpenseController', ['except' => ['edit', 'create', 'show']]);

/*
*  Expense Categories route
*/
Route::resource('expensecategory', 'ExpenseCategory\ExpenseCategoryController', ['except' => ['edit', 'create']]);


/*
*  Company route
*/
Route::resource('company', 'Company\CompanyController', ['except' => ['edit', 'create']]);
Route::get('selectedcompany/{id}', 'Company\CompanyTransactionController@selectedCompany')->name('selected_company');
Route::resource('ctransaction', 'Company\CompanyTransactionController', ['except' => ['edit', 'create', 'show']]);

/*
*  User route
*/

Route::resource('users','User\UserController',['except' => ['create', 'edit']]);
Route::name('verify')->get('users/verify/{token}', 'User\UserController@verify');
Route::name('resend')->get('users/{user}/resend', 'User\UserController@resend');


/*
 * Client auth
 */
Route::post('oauth/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');



/*
 *
 * Customer route
 *
 */

Route::resource('customers', 'Customer\CustomerController');


/*
 * ************************************************
 * Accounting go here
 * ************************************************
 */
Route::get('accounting/transaction', 'Accounting\TransactionAccountingController@index')->name('transaction.accounting');