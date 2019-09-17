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

Route::prefix('m01')->group(function () {
    Route::get('/', 'M01Controller@index');
    Route::get('m01110', 'M01110Controller@index')->name('m01110');
    Route::post('m01110', 'M01110Controller@index')->name('m01110');
    Route::get('m01110_tab1/{status}/{id?}', 'M01110Controller@view')->name('m01110_view');
    Route::post('m01110_tab1/{status}/{id?}', 'M01110Controller@save')->name('m01110_view');

    Route::get('m01110_tab2', 'M01110Controller@tab2')->name('m01110_tab2');
    Route::post('m01110_tab2', 'M01110Controller@tab2')->name('m01110_tab2');

    Route::get('m01110_tab2_view/{status}/{id?}', 'M01110Controller@tab2_view')->name('m01110_tab2_view');
    Route::post('m01110_tab2_view/{status}/{id?}', 'M01110Controller@save')->name('m01110_tab2_view');

    Route::get('m01120', 'M01120Controller@index')->name('m01120');
    Route::post('m01120', 'M01120Controller@index')->name('m01120');

    Route::get('m01120_view/{id?}', 'M01120Controller@view')->name('m01120_view');
    Route::post('m01120_view/{id?}', 'M01120Controller@save')->name('m01120_view');

    Route::get('m01120_view_tab2/{id?}', 'M01120Controller@view_tab2')->name('m01120_view_tab2');
    Route::post('m01120_view_tab2/{id?}', 'M01120Controller@save')->name('m01120_view_tab2');

    Route::get('m01120_view_tab3/{id?}', 'M01120Controller@view_tab3')->name('m01120_view_tab3');
    Route::post('m01120_view_tab3/{id?}', 'M01120Controller@save')->name('m01120_view_tab3');

    Route::get('m01130', 'M01130Controller@index')->name('m01130');
    Route::post('m01130', 'M01130Controller@index')->name('m01130');
    Route::get('m01130_view/{status}/{id?}', 'M01130Controller@view')->name('m01130_view');
    Route::post('m01130_view/{status}/{id?}', 'M01130Controller@save')->name('m01130_view');

    Route::get('m01140', 'M01140Controller@index')->name('m01140');
    Route::post('m01140', 'M01140Controller@index')->name('m01140');

    Route::get('m01140/Stda2', 'M01140Controller@Stda2')->name('m01140_Stda2');
    Route::post('m01140/Stda2', 'M01140Controller@Stda2');

    Route::get('m01140/Stda', 'M01140Controller@Stda')->name('m01140_Stda');
    Route::post('m01140/Stda', 'M01140Controller@Stda');

    Route::get('m01140/Stda3', 'M01140Controller@Stda3')->name('m01140_Stda3');
    Route::post('m01140/Stda3', 'M01140Controller@Stda3');

});
