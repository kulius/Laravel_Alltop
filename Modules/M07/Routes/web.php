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

Route::prefix('m07')->group(function () {
    //需求反應單填報
    Route::get('m07110', 'M07110Controller@index')->name('m07110');
    Route::post('m07110', 'M07110Controller@index');
    Route::get('m07110/{status}/{id?}', 'M07110Controller@view')->name('m07110_view');
    Route::post('m07110/{status}/{id?}', 'M07110Controller@save');

    //需求反應單維護
    Route::get('m07120', 'M07120Controller@index')->name('m07120');
    Route::post('m07120', 'M07120Controller@index');
    Route::get('m07120/{status}/{id?}', 'M07120Controller@view')->name('m07120_view');
    Route::post('m07120/{status}/{id?}', 'M07120Controller@save');

});
