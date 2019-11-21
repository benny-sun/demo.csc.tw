<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('/analytics')->group(function() {

    Route::get('browsers', 'AnalyticsFakeController@TopBrowsers');
    Route::get('user', 'AnalyticsFakeController@UserTypes');
    Route::get('visitors', 'AnalyticsFakeController@Visitors');
    Route::get('countries', 'AnalyticsFakeController@Countries');
    Route::get('avg-time-on-page', 'AnalyticsFakeController@AvgTimeOnPage');

    Route::get('browsers/{day}', 'AnalyticsFakeController@TopBrowsers');
    Route::get('user/{day}', 'AnalyticsFakeController@UserTypes');
    Route::get('visitors/{day}', 'AnalyticsFakeController@Visitors');
    Route::get('countries/{day}', 'AnalyticsFakeController@Countries');
    Route::get('avg-time-on-page/{day}', 'AnalyticsFakeController@AvgTimeOnPage');
    
});
