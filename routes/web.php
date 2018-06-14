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

Route::get('/', function () {
    return view('welcome');
});

Route::get('{n}', function ($n) {
    return view("article")->with('numero', $n);
})->where('n', '[0-9]+');

Route::get('facture/{n}', function ($n) {
    return view('facture')->withNumero($n);
})->where('n', '[0-9]+');

Route::get('/test', ['uses' => 'WelcomeController@index', 'as' => 'home']);

Route::get('/article/{n}', ['uses' => 'ArticleController@show', 'as' => 'article'])->where('n', '[0-9]+');

Route::get('users', 'UsersController@getInfos');
Route::post('users', 'UsersController@postInfos');

Route::get('contact', 'ContactController@getForm');
Route::post('contact', 'ContactController@postForm');

Route::get('profile/{n}', ['uses' => 'ProfileController@getForm', 'as' => 'profileid'])->where('n', '[0-9]+');
Route::post('profile/{n}', ['uses' => 'ProfileController@postForm', 'as' => 'profileid'])->where('n', '[0-9]+');

Route::get('email', 'EmailController@getForm');
Route::post('email', ['uses' => 'EmailController@postForm', 'as' => 'storeEmail']);

Auth::routes();

Route::get('/profile', 'HomeController@index')->name('profile');

Route::get('/profile/modify', 'Auth\ModifyAccountController@updateUserForm')->name('profile.modify');
Route::post('/profile/modify', 'Auth\ModifyAccountController@updateUser')->name('profile.update');

Route::get('/enterprise/register', 'Auth\EnterpriseController@redirect');
Route::post('/enterprise/register', 'Auth\EnterpriseController@store')->name('enterprise.register');

Route::get('/search', 'SearchController@index')->name('search');

Route::get('/offers', 'OffersController@index')->name('offers');
Route::get('/offers/create', function () {
    if (Auth::user()->enterprise != null) {
        return view('offer.createoffer');
    } else {
        return redirect('offers');
    }
})->name('offers.create')->middleware('auth');
Route::post('/offers/create', 'OffersController@create')->name('offers.create')->middleware('auth');
Route::get('offers/{n}', ['uses' => 'OffersController@offer', 'as' => 'offerid'])->where('n', '[0-9]+')->name('offers.offer')->middleware('auth');

Route::get('/mmi', function () {
    return view('mmi');
})->name('mmi');
