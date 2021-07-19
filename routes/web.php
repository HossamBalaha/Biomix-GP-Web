<?php

use Illuminate\Support\Facades\Route;

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
//    return redirect("/login");
//});

Route::group(['middleware' => ['web']], function () {
    Route::get('/', 'App\Http\Controllers\MainController@getLanding');

    Route::group(['middleware' => ['navigateFromRole']], function () {
        Route::get('/login', 'App\Http\Controllers\AuthController@getLogin')->name('login');
        Route::post('/login', 'App\Http\Controllers\AuthController@doLogin');
        Route::get('/register', 'App\Http\Controllers\AuthController@getRegistration');
        Route::post('/register', 'App\Http\Controllers\AuthController@doRegistration');
    });

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/logout', 'App\Http\Controllers\AuthController@doLogout');

        Route::group(['prefix' => 'user', 'middleware' => ['isUser']], function () {
            Route::get('/', 'App\Http\Controllers\UserController@index');
            Route::get('/breast-cancer', 'App\Http\Controllers\UserController@getBreastCancerView');
            Route::post('/breast-cancer', 'App\Http\Controllers\UserController@doClassification');
            Route::get('/symptoms', 'App\Http\Controllers\UserController@getSymptomsView');
            Route::get('/symptoms/start', 'App\Http\Controllers\UserController@getSymptomsStartView');
            Route::post('/symptoms/start', 'App\Http\Controllers\UserController@analyzeSymptoms');
            Route::get('/symptoms/latest-analyses', 'App\Http\Controllers\UserController@getLatestAnalysesView');
            Route::get('/profile', 'App\Http\Controllers\UserController@getProfileView');
            Route::get('/settings', 'App\Http\Controllers\UserController@getSettingsView');
            Route::post('/settings', 'App\Http\Controllers\UserController@updateSettings');
            Route::post('/change-password', 'App\Http\Controllers\UserController@updatePassword');
            Route::get('/sensor-readings', 'App\Http\Controllers\UserController@getReadingsView');
            Route::get('/sensor-readings/{id}/read', 'App\Http\Controllers\UserController@getLatestReadings');
            Route::post('/sensor-readings/{id}/clear', 'App\Http\Controllers\UserController@clearSensorReadings');
            Route::get('/tokens', 'App\Http\Controllers\UserController@getTokensView');
            Route::post('/tokens', 'App\Http\Controllers\UserController@addNewToken');
            Route::post('/tokens/{id}/remove', 'App\Http\Controllers\UserController@removeToken');
        });
    });
});
