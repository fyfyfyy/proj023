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
/*
Route::get('/', function () {
    return view('welcome');
});
*/


Route::get('/', function () {
    return view('frontend.index');
})->name('home');

Route::get('about', function () {
    return view('frontend.about');
})->name('about');
 
Route::get('products', function () {
    return view('frontend.products');
})->name('products');

Route::get('store', function () {
    return view('frontend.store');
})->name('store');




// 登入頁面
Route::get('/admin/login', function (){
    return view('backend.login');
});
Route::post('/admin/login', 'Auth\LoginController@login')->name('login');
// 用auth middleware進行驗證
// prefix 代表group內的url路徑前都有/admin/
// name 代表 group中route命名時，每個name的前綴會加入admin.
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function() {
 
    // 登出
    Route::get('/admin/logout', 'Auth\LoginController@logout')->name('logout');
 
    // Website的更新
    Route::get('/', 'Backend\WebsiteController@edit')->name('website.edit');
    Route::post('/', 'Backend\WebsiteController@update')->name('website.update');
 
    // Home的更新
    Route::get('home', 'Backend\HomeController@edit')->name('home.edit');
    Route::post('home', 'Backend\HomeController@update')->name('home.update');
 
    // About的更新
    Route::get('about', 'Backend\AboutController@edit')->name('about.edit');
    Route::post('about', 'Backend\AboutController@update')->name('about.update');
 
    // Product的增刪改查還有index頁面
    Route::resource('product', 'Backend\ProductController', ['except'=> ['show']]);
 
    // Store的更新
    Route::get('store', 'Backend\StoreController@edit')->name('store.edit');
    Route::post('store', 'Backend\StoreController@update')->name('store.update');
});


//前端的登記

// Website的更新
//Route::get('/', 'Frontend\WebsiteController')->name('website');
//Route::post('/', 'Frontend\WebsiteController')->name('website');

// Home的更新
Route::get('home', 'Frontend\HomeController@index')->name('home');
Route::get('home', 'Frontend\HomeController@index')->name('website');
//Route::post('home', 'Frontend\HomeController')->name('home');

// About的更新
Route::get('about', 'Frontend\AboutController@index')->name('about');
//Route::post('about', 'Frontend\AboutController')->name('about');

// Product的增刪改查還有index頁面
Route::resource('product', 'Frontend\ProductController@index', ['except'=> ['show']]);

// Store的更新
Route::get('store', 'Frontend\StoreController@index')->name('store');
//Route::post('store', 'Frontend\StoreController')->name('store');
