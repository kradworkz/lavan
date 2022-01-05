<?php

use Illuminate\Support\Facades\Route;
use Spatie\WelcomeNotification\WelcomesNewUsers;
use App\Http\Controllers\Auth\WelcomeController;
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


Auth::routes(['register' => false]);

Route::group(['middleware' => ['web', WelcomesNewUsers::class,]], function () {
    Route::get('welcome/{user}', [WelcomeController::class, 'showWelcomeForm'])->name('welcome');
    Route::post('welcome/{user}', [WelcomeController::class, 'savePassword']);
});

Route::prefix('request')->group(function(){

    Route::post('/user/password', 'HomeController@password');
    Route::get('/users/{key}/{counts}', 'UserController@lists');
    Route::post('/user/store', 'UserController@store');
    Route::get('/user/logs/{key}/{counts}', 'UserController@myLogs');

    Route::get('/facilities/{key}/{counts}', 'FacilityController@lists');
    Route::post('/facility/store', 'FacilityController@store');
    Route::get('/rooms', 'FacilityController@fetchRooms');

});

Route::get('/{any?}', 'HomeController@home')->where('any', '[\/\w\.-]*');

// Route::get('/{any?}', function() {
//     return view('home');
// });


