<?php


Route::get('/test', function () {

    dd(auth()->guard('vendor')->user()->name);
    return view('site.login');
});
Route::group(['namespace' => 'Vendor'], function () {
    Route::get('/register', 'AuthVendor@showVendorRegisterForm')->name('vendorRegister');
    Route::post('/register', 'AuthVendor@createVendor')->name('PostVendorRegister');
    Route::get('/login', 'AuthVendor@showVendorLoginForm')->name('showVendorLoginForm');
    Route::post('/login', 'AuthVendor@loginVendor')->name('PostLoginVendor');


    Route::group(['middleware' => 'Vendor:vendor'], function () {

        Route::get('/logout', 'AuthVendor@logout')->name('logoutVendor');

        Route::get('/home', function () {
            session()->forget('menu');
            session()->put('menu', 'home');
            return view('userVendor.home');
        })->name('vendorHome');
        //market route
        Route::get('markets/{id}', 'VendorMarket@index')->name('VendorMarket.index');
        Route::post('addNewMarkets/{id}', 'VendorMarket@postNew')->name('VendorAddNewMarkets');
        Route::post('updateVendorMarkets/{id}', 'VendorMarket@postUpdate')->name('VendorUpdateMarket');
        Route::post('/deleteVendorMarket/{id}', 'VendorMarket@delete')->name('VendorMarket.delete');


        //product route
        Route::get('vendorMarketProduct/{id}', 'Product@index')->name('vendorMarketProduct.index');
        Route::post('/deleteVendorProduct/{id}', 'Product@delete')->name('deleteVendorProduct.delete');
        Route::get('getAddNewProduct/{id}', 'Product@getNew')->name('getAddNewProduct');
        Route::post('/postAddNewProduct/{id}', 'Product@postNew')->name('postAddNewProduct');
        Route::get('getUpdateProduct/{id}', 'Product@getUpdate')->name('getUpdateProduct');
        Route::post('/postUpdateProduct/{id}', 'Product@postUpdate')->name('postUpdateProduct');


        //category route
        Route::get('allCategories', 'Category@index')->name('vendorallCategories.index');
        Route::post('/deleteCategory/{id}', 'Category@delete')->name('vendordeleteCategory.delete');
        Route::post('addNewCategory', 'Category@addNew')->name('vendoraddNewCategory');

        //employees route
        Route::get('vendorEmployees/{id}', 'Employee@index')->name('vendorEmployees.index');
        Route::get('vendorAddEmployees', 'Employee@getNew')->name('vendorAddEmployees');
        Route::post('vendorAddEmployees', 'Employee@postNew')->name('vendorPostAddEmployees');
        Route::get('vendorUpdateEmployees/{id}', 'Employee@getUpdate')->name('vendorUpdateEmployees');
        Route::post('vendorUpdateEmployees/{id}', 'Employee@postUpdate')->name('vendorPostUpdateEmployees');
        Route::post('/vendorDeleteEmployee/{id}', 'Employee@delete')->name('vendorDeleteEmployee.delete');

    });


});
