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
Auth::routes();
Route::get('/','HomeController@root' );
Route::get('/home', 'HomeController@index')->name('home');
Route::post('excel/import/delivery', 'ExcelController@import_delivery')->name('excel.import_delivery');
Route::post('excel/import/config', 'ExcelController@import_config')->name('excel.import_config');
Route::get('/pos/list', 'POSController@list')->name('pos.list');
Route::post('/pos/update', 'POSController@update')->name('pos.update');
Route::post('/pos/delete', 'POSController@delete')->name('pos.delete');
Route::get('excel/export', 'ExcelController@export');
Route::get('export/downloadfile', 'ExcelController@DownloadFile')->name('download');
