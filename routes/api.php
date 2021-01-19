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

Route::get('academic-industry', 'AnnouncementController@getAnnouncements');
Route::post('academic-industry', 'AnnouncementController@create');
Route::put('academic-industry', 'AnnouncementController@update');

// keep for dashboard feature
Route::get('companies', 'CompanyController@getCompanies');
