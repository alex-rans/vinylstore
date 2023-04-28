<?php

use App\Genre;
use App\Record;
use Illuminate\Support\Facades\Route;
use function Doctrine\Common\Cache\Psr6\get;

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

//Route::get('/', function () {
//    // return view('welcome');
//    return('Bruh moment');
//});
//Route::get('contact-us', function () {
//    return view('contact');
//});
Route::view('/', 'home');
Route::get('shop', 'ShopController@index');
Route::get('shop/{id}', 'ShopController@show');
Route::get('contact-us', 'ContactUsController@show');
Route::post('contact-us', 'ContactUsController@sendEmail');
Route::get('itunes', 'ItunesController@index');

Route::prefix('admin')->group(function () {
    Route::redirect('/', '/admin/records');
    Route::get('records', 'Admin\RecordController@index');
});

Route::get('basket', 'BasketController@index');
Route::get('basket/add/{id}', 'BasketController@addToCart');
Route::get('basket/delete/{id}', 'BasketController@deleteFromCart');
Route::get('basket/empty', 'BasketController@emptyCart');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::redirect('/', '/admin/records');
    Route::get('genres/qryGenres', 'Admin\GenreController@qryGenres');
    Route::resource('genres', 'Admin\GenreController');
    Route::get('genres2/qryGenres', 'Admin\Genre2Controller@qryGenres');
    Route::resource('genres2', 'Admin\Genre2Controller', ['parameters' => ['genres2' => 'genre']]);
    Route::resource('records', 'Admin\RecordController');
});
Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::redirect('/', '/user/profile');
    Route::get('profile', 'User\ProfileController@edit');
    Route::post('profile', 'User\ProfileController@update');
    Route::get('password', 'User\PasswordController@edit');
    Route::post('password', 'User\PasswordController@update');

    //payment
    Route::get('history', 'User\HistoryController@index');
    Route::post('charge', 'User\HistoryController@charge');
    Route::get('success', 'User\HistoryController@success');
    Route::get('error', 'User\HistoryController@error');

    Route::get('checkout', 'User\HistoryController@checkout');
});

