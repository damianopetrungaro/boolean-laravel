<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Braintree\Gateway as Gateway;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//HOME
Route::get('/', 'RestaurantController@index')->name('home');
Route::get('/guests/payed', 'RestaurantController@payed')->name('payed');
//ROTTE UI
Route::get('/restaurants/{slug}', 'RestaurantController@show')->name('restaurants.show');

//ROTTE PER LOGIN / REGISTRAZIONE
Auth::routes();

//ROTTE PAGINE PER UTENTI LOGGATI
Route::prefix('admin')
    ->namespace('Admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function() {
        //Home admin
        Route::get('/', 'HomeController@index')->name('home');

        //ROTTE Restaurants CRUD
        Route::resource('restaurants', 'RestaurantController');

        //ROTTE Foods CRUD
        Route::resource('foods', 'FoodController');
    });

    //ROTTE PAGAMENTO
    // Route::get('/payment/make', 'PaymentsController@make')->name('payment.make');

Route::get('/guests/payment', function () {
    $gateway = new Gateway([
        'environment' => 'sandbox',
        'merchantId' => '4wvx6k87m9sxq5k3',
        'publicKey' => 'p4rqqmp276684b36',
        'privateKey' => 'c7e93c2e0a9728be721a0140af83f1ae'
    ]);

    $clientToken = $gateway->clientToken()->generate();

    return view('guests.payment', compact('clientToken'));
})->name('pay');

