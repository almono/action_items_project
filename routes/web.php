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

Route::get('/', ['uses' => 'HomePageController@index']);
Route::post('/seed-file', ['uses' => 'HomePageController@uploadJson', 'as' => 'seed_data']);
Route::post('/upload-file', ['uses' => 'HomePageController@uploadFile', 'as' => 'upload-action-file']);
Route::get('/download-file/{id}', ['uses' => 'HomePageController@downloadFile', 'as' => 'download-file']);

Route::resources([
    'actions' => 'HomePageController'
]);