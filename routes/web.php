<?php

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

//Route::get('/test', function () {
////    isset($_GET['category']) ?dd($_GET['category']) : dd('aa');
//        $categories = \App\Gategory::all();
//
//return view('site.products-shope', compact('categories'));
//})->name('test');


Route::get('ar', 'Lang@ar')->name('ar');
Route::get('en', 'Lang@en')->name('en');

Route::group(['middleware' => 'Lang'], function () {

    Route::get('auth/facebook', 'Auth\RegisterController@redirectToProvider')->name('facebook');
    Route::get('auth/facebook/callback', 'Auth\RegisterController@handleProviderCallback');
//    Route::get('/filter', function () {
//        $categories = \App\Gategory::all();
//        return view('site.recommend', compact('categories'));
//    })->name('siteFilter');
    Route::group(['namespace' => 'Site'], function () {

        Route::get('/clientRegister', 'Client@showClientRegisterForm')->name('siteRegister');
        Route::post('/clientRegister', 'Client@createClient')->name('sitePostRegister');

        Route::get('/clientLogin', 'Client@showClintLoginForm')->name('siteLogin');
        Route::post('/clientLogin', 'Client@loginClint')->name('sitePostLogin');
        Route::get('/clientLogout', 'Client@logout')->name('siteLogout');

//products route
        Route::get('/allProduct', 'Product@allProduct')->name('siteProduct');
        Route::get('/siteProductDetail/{id}', 'Product@productInfo')->name('siteProductDetail');
        //home route
        Route::get('/', 'Product@siteIndex')->name('siteHome');
        Route::resource('shoping', 'shopingcontroller');
// recommend route
        Route::get('/filter', 'Recommend@index')->name('siteFilter');
        Route::get('/allFilterProduct', 'Recommend@allProduct')->name('allSiteFilterProduct');
//all market route
        Route::get('/siteAllMarkets', 'AllMarkets@index')->name('siteAllMarkets');
        Route::get('/allSiteMarketProduct/{id}', 'AllMarkets@allProduct')->name('allSiteMarketProduct');


//order route
        Route::group(['middleware' => 'auth'], function () {
            Route::get('/checkout', 'Checkout@indexs')->name('checkout');
            Route::post('/checkout', 'Checkout@saveOrder')->name('postCheckout');
        });
    });

    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');
});
