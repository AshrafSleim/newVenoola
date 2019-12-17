<?php

Route::get('/ashraf', function () {

    return view('admin.login');
});

Auth::routes();
Route::get('/login', 'admin@showAdminLoginForm')->name('AdminLogin');
Route::post('/login', 'admin@loginAdmin')->name('PostAdminLogin');

Route::group(['middleware' => 'Admin:admin'], function () {
    Route::get('/register', 'admin@showAdminRegisterForm')->name('AdminRegistration');
    Route::post('/register', 'admin@createAdmin')->name('PostAdminRegistration');

    Route::get('/', function () {
        session()->forget('menu');
        session()->put('menu', 'home');
        return view('admin.home');
    })->name('adminHome');

    Route::get('/logout', 'admin@logout')->name('logoutAdmin');
    Route::group(['namespace' => 'Admin'], function () {
//user route
        Route::get('user', 'User@index')->name('adminUser.index');
        Route::post('/deleteUser/{id}', 'User@delete')->name('adminUser.delete');
//vendor route
        Route::get('vendor', 'Vendor@index')->name('adminVendor.index');
        Route::post('/deleteVendor/{id}', 'Vendor@delete')->name('adminVendor.delete');
        Route::get('vendorMarkets/{id}', 'Vendor@showMarkets')->name('adminVendorMarket.index');
        Route::post('/deleteVendorMarket/{id}', 'Vendor@deleteMarket')->name('adminVendorMarket.delete');
//allMarket route
        Route::get('allMarkets', 'Markets@index')->name('allMarkets.index');
        Route::post('/deleteMarket/{id}', 'Markets@delete')->name('deleteMarket.delete');
        Route::post('/updateStatus/{id}', 'Markets@updateStatus')->name('updateMarketStatus');
//category route
        Route::get('allCategories', 'Category@index')->name('allCategories.index');
        Route::post('/deleteCategory/{id}', 'Category@delete')->name('deleteCategory.delete');
        Route::post('addNewCategory', 'Category@addNew')->name('addNewCategory');
//event route
        Route::get('allEvent', 'Event@index')->name('allEvent.index');
        Route::post('/deleteEvent/{id}', 'Event@delete')->name('deleteEvent.delete');
        Route::post('addNewEvent', 'Event@addNew')->name('addNewEvent');
//brand route
        Route::get('allBrand', 'Brand@index')->name('allBrand.index');
        Route::post('/deleteBrand/{id}', 'Brand@delete')->name('deleteBrand.delete');
        Route::post('addNewBrand', 'Brand@addNew')->name('addNewBrand');
//brand route
        Route::get('allRelation', 'Relation@index')->name('allRelation.index');
        Route::post('/deleteRelation/{id}', 'Relation@delete')->name('deleteRelation.delete');
        Route::post('addNewRelation', 'Relation@addNew')->name('addNewRelation');
//product route
        Route::get('marketProduct/{id}', 'Product@index')->name('marketProduct.index');
        Route::post('/deleteProduct/{id}', 'Product@delete')->name('deleteProduct.delete');
//booking route
        Route::get('booked', 'Booked@index')->name('adminBook.index');
        Route::post('/deleteBook/{id}', 'Booked@delete')->name('adminBook.delete');
        Route::get('/showBook/{id}', 'Booked@show')->name('adminShowBook');
        Route::post('/updateBookStatus/{id}', 'Booked@updateStatus')->name('updateBookStatus');
        Route::get('/prinview/{id}', 'Booked@print')->name('print');
//allProduct
        Route::get('adminAllProduct', 'AllProduct@index')->name('adminAllProduct.index');
        Route::get('adminUpdateProduct/{id}', 'AllProduct@getUpdate')->name('adminUpdateProduct');
        Route::post('adminUpdateProduct/{id}', 'AllProduct@postUpdate')->name('adminPostUpdateProduct');
        Route::post('/deleteAdminProduct/{id}', 'AllProduct@delete')->name('deleteAdminProduct.delete');

    });
});
