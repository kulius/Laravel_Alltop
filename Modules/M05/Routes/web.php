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

Route::prefix('m05')->group(function () {
    Route::get('/', 'M05Controller@index');

    Route::get('m05110', 'M05110Controller@index')->name('m05110');
    Route::post('m05110', 'M05110Controller@index')->name('m05110');

    Route::get('m05110_tab2', 'M05110Controller@tab2')->name('m05110_tab2');
    Route::post('m05110_tab2', 'M05110Controller@tab2')->name('m05110_tab2');

});
