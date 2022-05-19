<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\DetailUser;

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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group([
    'middleware' => 'auth',
], function () {
    Route::get('/cabinet', 'UserController@index')->name('cabinet');
    Route::get('/spending', 'UserController@spending')->name('spending');
    Route::get('/career', 'UserController@career')->name('career');

    Route::post('/step', 'UserPostController@step')->name('step');
    Route::post('/spending_change', 'UserPostController@spendingChange')->name('spending_change');
    Route::post('/spending_food_change', 'UserPostController@spendingFoodChange')->name('spending_food_change');
    Route::post('/spending_servant', 'UserPostController@spendingServant')->name('spending_servant');
    Route::post('/spending_delete', 'UserPostController@spendingDelete')->name('spending_delete');
    Route::post('/spending_servant_delete', 'UserPostController@spendingServantDelete')->name('spending_servant_delete');

    Route::post('/search_work', 'UserPostController@searchWork')->name('search_work');
    Route::post('/more_work', 'UserPostController@moreWork')->name('more_work');
    Route::post('/up_post', 'UserPostController@upPost')->name('up_post');
    Route::post('/get_out_work', 'UserPostController@getOutWork')->name('get_out_work');
});
