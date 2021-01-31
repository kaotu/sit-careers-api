<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('company', 'CompanyController@get');
Route::post('company', 'CompanyController@create');
Route::put('company', 'CompanyController@update');
Route::delete('company', 'CompanyController@destroy');

Route::prefix('academic-industry')->group(function () {
    Route::get('announcement', 'AnnouncementController@get');
    Route::get('announcements', 'AnnouncementController@getAnnouncements');
    Route::post('announcement', 'AnnouncementController@create');
    Route::put('announcement', 'AnnouncementController@update');
    Route::delete('announcement', 'AnnouncementController@destroy');
});

// keep for dashboard feature
Route::get('companies', 'CompanyController@getCompanies');
