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

    Route::get('/notifications', 'HomeController@notifications');
    Route::get('/seen/{id}', 'HomeController@seen');

    Route::get('/municipalities/{keyword}/{count}', 'MunicipalityController@index');
    Route::post('/municipality/store', 'MunicipalityController@store');
    Route::get('/municipalities', 'MunicipalityController@lists');
    Route::get('/municipality/{id}', 'MunicipalityController@view');
    Route::post('/barangay/store', 'MunicipalityController@storeb');

    Route::get('/dropdowns/{type}/{keyword}/{count}', 'DropdownController@index');
    Route::get('/dropdowns/{type}', 'DropdownController@lists');
    Route::post('/dropdown/store', 'DropdownController@store');

    Route::post('/user/password', 'UserController@password');
    Route::get('/users/{key}/{counts}', 'UserController@lists');
    Route::post('/user/store', 'UserController@store');
    Route::get('/user/logs/{key}/{counts}', 'UserController@myLogs');

    Route::get('/facilities/{key}/{counts}', 'FacilityController@index');
    Route::get('/facility/{id}', 'FacilityController@view');
    Route::get('/facilities/{type}', 'FacilityController@type');
    Route::post('/facility/store', 'FacilityController@store');
    Route::post('/facility/search', 'FacilityController@search');
    Route::get('/beds/{id}', 'FacilityController@fetchBeds');
    Route::post('/bed/store', 'FacilityController@storeBed');

    Route::get('/patients/{key}/{counts}', 'PatientController@index');
    Route::get('/patient/{id}', 'PatientController@view');
    Route::post('/patient/store', 'PatientController@store');
    Route::post('/patient/search', 'PatientController@search');

    Route::get('/admissions/{key}/{status}/{counts}', 'AdmissionController@index');
    Route::post('/admission/store', 'AdmissionController@store');
    Route::post('/admission/checkout', 'AdmissionController@checkout');
    Route::post('/admission/test', 'AdmissionController@test');
    Route::post('/admission/void', 'AdmissionController@void');

    Route::get('/dashboard/tests', 'DashboardController@testLists');
    Route::get('/dashboard/releasing', 'DashboardController@releasing');
    Route::get('/dashboard/admin', 'DashboardController@admin');
    Route::get('/dashboard/index', 'DashboardController@index');
});

Route::prefix('statistics')->group(function(){
    Route::get('/index', 'StatisticController@index');
});

Route::get('/{any?}', 'HomeController@home')->where('any', '[\/\w\.-]*');

// Route::get('/{any?}', function() {
//     return view('home');
// });


