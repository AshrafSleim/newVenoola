<?php


use App\VendorEmployee;

Route::get('/test', function () {
//dd('yes');
//    dd(auth()->guard('vendor')->user()->name);
    $roles = VendorEmployee::find(1)->market()->orderBy('name')->get();
    dd($roles);
    return view('site.login');
});
Route::group(['namespace' => 'Employee'], function () {
//    Route::get('/register', 'AuthVendor@showVendorRegisterForm')->name('vendorRegister');
//    Route::post('/register', 'AuthVendor@createVendor')->name('PostVendorRegister');
    Route::get('/emploeelogin', 'AuthEmployee@showEmployeeLoginForm')->name('showEmployeeLoginForm');
    Route::post('/emploeelogin', 'AuthEmployee@login')->name('PostLoginEmployee');
//
//

    Route::group(['middleware' => 'Employee:employee'], function () {
//
        Route::get('/logout', 'AuthEmployee@logout')->name('logoutEmployee');
//
        Route::get('/home', function () {
            session()->forget('menu');
            session()->put('menu', 'home');
            return view('employee.home');
        })->name('vendorHome');
        //market route
        Route::get('markets/{id}', 'EmployeeMarket@index')->name('EmployeeMarket.index');
        Route::post('addNewEmployeeMarkets/{id}', 'EmployeeMarket@postNew')->name('EmployeeAddNewMarkets');
        Route::post('updateEmployeeMarkets/{id}', 'EmployeeMarket@postUpdate')->name('EmployeeUpdateMarket');
        Route::post('/deleteEmployeeMarket/{id}', 'EmployeeMarket@delete')->name('EmployeeMarket.delete');
//
//
//        product route
        Route::get('employeeMarketProduct/{id}', 'Product@index')->name('employeeMarketProduct.index');
        Route::post('/deleteEmployeeProduct/{id}', 'Product@delete')->name('deleteemployeeProduct.delete');
        Route::get('getAddNewProductemployee/{id}', 'Product@getNew')->name('employeegetAddNewProduct');
        Route::post('/postAddNewProductemployee/{id}', 'Product@postNew')->name('employeepostAddNewProduct');
        Route::get('getUpdateProductemployee/{id}', 'Product@getUpdate')->name('employeegetUpdateProduct');
        Route::post('/postUpdateProductemployee/{id}', 'Product@postUpdate')->name('employeepostUpdateProduct');

//
        //category route
        Route::get('allCategoriesEmployee', 'Category@index')->name('EmployeeallCategories.index');
        Route::post('/deleteCategoryEmployee/{id}', 'Category@delete')->name('EmployeedeleteCategory.delete');
        Route::post('addNewCategoryEmployee', 'Category@addNew')->name('EmployeeaddNewCategory');


    });
//

});
